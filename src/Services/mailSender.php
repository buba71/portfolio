<?php

namespace App\Services;


use Monolog\Logger;
use Psr\Log\LoggerInterface;

class mailSender
{
    private $logger;
    private $mailer;

    /**
     * mailSender constructor.
     * @param \Swift_Mailer $mailer
     */
    public function __construct(\Swift_Mailer $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * @param $mail
     * @param $lastName
     * @param $firstName
     * @param $content
     * @throws \Swift_SwiftException
     * @ Send Mail service. Throw exception if fail
     */
    public function sendMail($mail, $lastName, $firstName, $content):void
    {
        $newMail = (new \Swift_Message('Un nouveau message reçu'))
            ->setFrom('d.delima@outlook.fr')
            ->setTo('davdelima@gmail.com')
            ->setBody('Voici un message de la part de Monsieur : ' . $lastName . ' ' . $firstName .'<br/>' .
                'adresse mail : ' . $mail . '<br/>' .
                $content . '<br/>'
            );
        // if error mailling, throw exception
       if(!$this->mailer->send($newMail, $failures)) {

           throw new \Swift_TransportException('Une erreur s\'est produite lors de l\'envoi de ce mail : ' . $mail . ' , /Erreur : ' . $failures);
           // Logging error
           $this->logger->critical('Une erreur s\'est produite lors de l\'envoi de ce mail : ' . $mail . ' , /Erreur : ' . $failures);

       } ;

       $this->logger->info('Message from : ' . $mail . ' was sent' );

    }

}