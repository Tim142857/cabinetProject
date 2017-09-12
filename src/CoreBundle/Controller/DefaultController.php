<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $name = $request->request->get('name');
        $firstName = $request->request->get('firstName');
        $phone = $request->request->get('phone');
        $mail = $request->request->get('mail');
        $message = $request->request->get('message');
        if ($name != null || $firstName != null || $phone != null || $mail != null || $message != null) {
            $transporter = \Swift_SmtpTransport::newInstance('173.194.65.108', 465, 'ssl')
                ->setUsername('timothyleroch@gmail.com')
                ->setPassword('#Google142857');

            $mailer = \Swift_Mailer::newInstance($transporter);

            $message = \Swift_Message::newInstance()
                ->setSubject('sujet')
                ->setFrom('timothyleroch@gmail.com')
                ->setTo('timothyleroch@gmail.com')
                ->setBody('toto');

            $mailer->send($message);

            return $this->render('CoreBundle::index.html.twig');
        }
        return $this->render('CoreBundle::index.html.twig');
    }
}
