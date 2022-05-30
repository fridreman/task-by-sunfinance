<?php

namespace App\Dto;

use App\Validator\Constraints\NotificationBatchIntegrity;

final class NotificationMultipleRequest
{
    /**
     * @NotificationBatchIntegrity
     */
    private ?array $notifications;

    public function __construct(?array $notifications)
    {
        $this->notifications = $notifications;
    }

    public function getNotifications(): ?array
    {
        return $this->notifications;
    }
}