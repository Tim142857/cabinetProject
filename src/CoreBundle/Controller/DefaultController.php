<?php

namespace CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $name = $request->request->get('name');
        $firstName = $request->request->get('firstName');
        $phone = $request->request->get('phone');
        $mail = $request->request->get('mail');
        $contactMessage = $request->request->get('message');
        if ($name != null || $firstName != null || $phone != null || $mail != null || $contactMessage != null) {
            $transporter = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
                ->setUsername('nellylelu@gmail.com')
                ->setPassword('edctsldbzmrtbflv');

            $mailer = \Swift_Mailer::newInstance($transporter);

            $message = \Swift_Message::newInstance()
                ->setSubject('Nouvelle demande de contact')
                ->setFrom('Webmaster@gmail.com')
                ->setTo('nellylelu@gmail.com')
                ->setBody('toto');
            $body = 'Vous avez reçu une nouvelle demande de contact le ' . date("d-m-Y") . '.' . "\n" . "\n";
            $body .= 'Nom: ' . $name . "\n";
            $body .= "Prénom: " . $firstName . "\n";
            $body .= "Mail: " . $mail . "\n";
            $body .= "Téléphone: " . $phone . "\n";
            $body .= "Message: " . "\n" . "\n" . $contactMessage . "\n";
            $message->setBody($body);

            $mailer->send($message);
            $this->get('session')->getFlashBag()->add('contact', 'Votre demande de contact a bien été envoyée.');
            return $this->render('CoreBundle::index.html.twig');
        }
        return $this->render('CoreBundle::index.html.twig');
    }
}
