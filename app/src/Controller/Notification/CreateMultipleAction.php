<?php

declare(strict_types=1);

namespace App\Controller\Notification;

use ApiPlatform\Core\OpenApi\Model\Response;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Entity\Notification;
use App\Service\Message\NotificationMessage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\MessageBusInterface;

final class CreateMultipleAction extends AbstractController
{
    public function __construct(
        private ValidatorInterface     $validator,
        private EntityManagerInterface $entityManager,
        private MessageBusInterface    $bus,
    ) {}

    /**
     * @param array<Notification> $data
     * @return Response
     */
    public function __invoke(array $data): Response
    {
        $messages = [];
        foreach ($data as $notification) {
            $this->validator->validate($notification);
            $messages[] = new NotificationMessage($notification);

            $this->entityManager->persist($notification);
        }

        $this->entityManager->flush();

        foreach ($messages as $message) {
            $this->bus->dispatch($message);
        }

        return new Response();
    }
}