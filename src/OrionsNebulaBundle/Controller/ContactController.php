<?php

namespace OrionsNebulaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function contactAction(Request $req)
    {

        // Set render variables
        $name = $req->get('name');
        $email = $req->get('email');
        $subject = $req->get('subject');
        $message = $req->get('message');
        $msg = null;

        // If submit button was pressed
        if($req->getMethod() == 'POST')
        {
            $msg = $this->checkForm($name, $email, $subject, $message);
        }

        // If form is valid send email
        if(empty($msg) && $req->getMethod() == 'POST')
        {
            $this->sendEmail($name, $email, $subject, $message);

            $msg = 'Email sent!';
        }

        // Render form
        return $this->render(
            'OrionsNebulaBundle:Contact:contact.html.twig',
            array(
                'name' => $name,
                'email' => $email,
                'subject' => $subject,
                'message' => $message,
                'msg' => $msg
            )
        );
    }


    public function checkForm($name, $email, $subject, $message)
    {
        $msg = null;

        // Make sure email has content
        if (empty($name) || empty($email) || empty($subject) || empty($message)) {

            $msg = 'Make sure all fields are filled in';

            // Make sure email is valid
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $msg = 'Invalid email entered';

        }

        return $msg;
    }


    public function sendEmail($name, $email, $subject, $message)
    {

        // Prepare email to send to me
        $mail = \Swift_Message::newInstance()
            ->setSubject('ORIONS NEBULA EMAIL: ' . $subject)
            ->setFrom('jared.orion.selcoe@gmail.com')
            ->setTo('jared.orion.selcoe@gmail.com')
            ->setBody(
                $this->renderView(
                    'OrionsNebulaBundle:Email:emailToMe.html.twig',
                    array(
                        'name' => $name,
                        'email' => $email,
                        'message' => \nl2br($message)
                    )
                ),
                'text/html'
            );

        // Send email
        $this->get('mailer')->send($mail);

        // Prepare email to send to user
        $mail = \Swift_Message::newInstance()
            ->setSubject('You Sent Jared An Email Titled "' . $subject . '" Via www.orions-nebula.com')
            ->setFrom('jared.orion.selcoe@gmail.com')
            ->setTo($email)
            ->setBody(
                $this->renderView(
                    'OrionsNebulaBundle:Email:emailToUser.html.twig',
                    array(
                        'name' => $name,
                        'message' => \nl2br($message)
                    )
                ),
                'text/html'
            );

        // Send email
        $this->get('mailer')->send($mail);
    }
}