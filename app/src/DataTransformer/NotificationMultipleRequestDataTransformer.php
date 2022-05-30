<?php

declare(strict_types=1);

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Exception\ItemNotFoundException;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Dto\NotificationMultipleRequest;
use App\Entity\Notification;
use App\Repository\ClientRepository;

final class NotificationMultipleRequestDataTransformer implements DataTransformerInterface
{
    public function __construct(
        private ValidatorInterface $validator,
        private ClientRepository   $clientRepository,
    ) {}

    /**
     * @param NotificationMultipleRequest $object
     * @param string $to
     * @param array $context
     * @return array
     */
    public function transform($object, string $to, array $context = []): array
    {
        $this->validator->validate($object, $context);

        $notifications = [];
        foreach ($object->getNotifications() as $item) {
            if (!$client = $this->clientRepository->find($item['client'])) {
                throw new ItemNotFoundException("Client {$item['client']} not found.");
            }

            $notification = new Notification();
            $notification->setClient($client);
            $notification->setChannel($item['channel']);
            $notification->setContent($item['content']);

            $notifications[] = $notification;
        }

        return $notifications;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof Notification) {
            return false;
        }

        return Notification::class === $to && NotificationMultipleRequest::class === ($context['input']['class'] ?? null);
    }
}