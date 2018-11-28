<?php

namespace App\Services;

class IsAdult
{
    public function checkAge($age)
    {
        return ( $age >= 18 ? true : false);
    }
}
