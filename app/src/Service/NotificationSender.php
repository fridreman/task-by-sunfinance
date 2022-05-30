<?php

namespace App\Service;

use App\Entity\Notification;
use App\Service\Sender\NotificationSenderInterface;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;

final class NotificationSender
{
    /**
     * @param iterable<NotificationSenderInterface> $senders
     */
    public function __construct(private iterable $senders, private EntityManagerInterface $entityManager)
    {
    }

    #[NoReturn] public function send(Notification $notification)
    {
        foreach ($this->senders as $sender) {
            if ($sender->supportsSending($notification) && $sender->send($notification)) {
                $notification->setDelivered(true);
            }
        }

        $this->entityManager->flush();
    }
}