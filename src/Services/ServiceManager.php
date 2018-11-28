<?php

namespace App\Services;

class ServiceManager
{
    private $ageCalculator;
    private $isAdult;

    /**
     * ServiceManager constructor.
     * @param $ageCalculator
     * @param $isAdult
     */
    public function __construct(AgeCalculator $ageCalculator, IsAdult $isAdult)
    {
        $this->ageCalculator = $ageCalculator;
        $this->isAdult = $isAdult;
    }

    public function calculateAge(\DateTime $date)
    {
        return $this->ageCalculator->getAge($date);
    }

    public function checkAge($age)
    {
        return $this->isAdult->checkAge($age);
    }
}
