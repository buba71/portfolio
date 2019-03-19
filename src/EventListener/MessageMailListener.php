<?php

namespace App\EventListener;

use App\Services\mailSender;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\entity\Message;

class MessageMailListener

{
    private $mailSender;

    /**
     * MessageMailListener constructor.
     * @param mailSender $mailSender
     */
    public function __construct(mailSender $mailSender)
    {
        $this->mailSender = $mailSender;
    }

    /**
     * @param LifecycleEventArgs $args
     * @throws \Swift_SwiftException
     * @ Event Listener on MAil post Persist
     */
    public function postPersist (LifecycleEventArgs $args)
    {
        $message = $args->getObject();

        if (!$message instanceof Message) {
            return;
        }

        $this->mailSender->sendMail(
            $message->getSenderMail(),
            $message->getSenderLastName(),
            $message->getSenderFirstName(),
            $message->getContent()
        );
    }
}


