<?php

namespace App\Service\Message;

use App\Service\NotificationSender;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class NotificationMessageHandler implements MessageHandlerInterface
{
    public function __construct(private NotificationSender $notificationSender)
    {
    }

    #[NoReturn] public function __invoke(NotificationMessage $message)
    {
        $this->notificationSender->send($message->getNotification());
    }
}