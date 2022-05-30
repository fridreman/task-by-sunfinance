<?php

namespace App\Service\Sender;

use App\Entity\Notification;

class SmsSender implements NotificationSenderInterface
{
    const TYPE = "sms";

    public function send(Notification $notification): bool
    {
        // TODO: Implement send() method.
        return true;
    }

    public function supportsSending(Notification $notification): bool
    {
        return $notification->getChannel() === self::TYPE;
    }
}