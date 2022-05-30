<?php

namespace App\Service\Sender;

use App\Entity\Notification;

interface NotificationSenderInterface
{
    public function send(Notification $notification): bool;
    public function supportsSending(Notification $notification): bool;
}