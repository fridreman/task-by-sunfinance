<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NotificationBatchIntegrity extends Constraint
{
    public string $message = 'The notification must have the "param_property" property';
}