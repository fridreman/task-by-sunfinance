<?php

namespace App\Service\Sender;

use App\Entity\Notification;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailSender implements NotificationSenderInterface
{
    const TYPE = "email";

    public function __construct(private MailerInterface $mailer)
    {
    }

    public function send(Notification $notification): bool
    {
        $email = (new Email())
            ->from('hello@example.com')
            ->to($notification->getClient()->getEmail())
            ->subject('Time for Symfony Mailer!')
            ->text($notification->getContent());

        $this->mailer->send($email);

        return true;
    }

    public function supportsSending(Notification $notification): bool
    {
        return $notification->getChannel() === self::TYPE;
    }
}