<?php

namespace App\Services;

class AgeCalculator
{
    public function getAge(\DateTime $birthday): string
    {
        $now = new \DateTime('now');
        $age = $now->diff($birthday);

        return $age->format('%y');
    }
}
