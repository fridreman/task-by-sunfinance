<?php

declare(strict_types=1);

namespace App\Dto;

use App\Entity\Notification;
use App\Validator\Constraints\NotificationBatchIntegrity;

final class NotificationMultipleRequest
{
    /**
     * @NotificationBatchIntegrity
     */
    private array $notifications;

    public function __construct(array $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * @return array<Notification>
     */
    public function getNotifications(): array
    {
        return $this->notifications;
    }
}