<?php

namespace App\Controller;

use App\GoogleApi\WeatherService;
use App\Model\NullWeather;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Validation\ValidateService;

class WeatherController extends AbstractController
{
    public function index($day)
    {
        try {
            $validator = new ValidateService();
            if ( $validator->validate($day) ) {
                $fromGoogle = new WeatherService();
                $weather = $fromGoogle->getDay(new \DateTime($day));
            } else {
                $weather = new NullWeather();
            }
        } catch (\Exception $exp) {
            $weather = new NullWeather();
        }

        return $this->render('weather/index.html.twig', [
            'weatherData' => [
                'date'      => $weather->getDate()->format('Y-m-d'),
                'dayTemp'   => $weather->getDayTemp(),
                'nightTemp' => $weather->getNightTemp(),
                'sky'       => $weather->getSky()
            ],
        ]);
    }
}
