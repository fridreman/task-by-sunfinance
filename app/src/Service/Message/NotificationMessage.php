<?php

declare(strict_types=1);

namespace App\Service\Message;

use App\Entity\Notification;

final class NotificationMessage
{
    public function __construct(
        private Notification $notification,
    ) {}

    public function getNotification(): Notification
    {
        return $this->notification;
    }
}