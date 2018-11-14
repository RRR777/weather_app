<?php


namespace App\Validation;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints as Assert;

class ValidateService
{
    public function validate($date)
    {
        $today = (new \DateTime)->format('Y-m-d');
        $dateTo = date('Y-m-d', strtotime('+2 years', strtotime($today)));

        $validator = Validation::createValidator();
        $violations = $validator->validate($date, [
            new Assert\NotBlank(),
            new Assert\Date(),
            new Assert\GreaterThan($today),
            new Assert\LessThan($dateTo)
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                echo $violation->getMessage().'<br>';
            }
            return false;
        }
        return true;
    }
}
