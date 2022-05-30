<?php

declare(strict_types=1);

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * @Annotation
 */
final class NotificationBatchIntegrityValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint): void
    {
        foreach ($value as $item) {
            if ($properties = array_diff(['client', 'channel', 'content'], array_keys($item))) {
                $this
                    ->context
                    ->buildViolation($constraint->message)
                    ->setParameter('param_property', array_pop($properties))
                    ->addViolation();
            }
        }
    }
}