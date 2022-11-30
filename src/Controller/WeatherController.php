<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;

class WeatherController extends AbstractController
{
    public function cityAction($city, WeatherUtil $weatherService): Response
    {
        $measurements = $weatherService->getWeatherForCountryAndCity($city);

        return $this->render('weather/city.html.twig', $measurements);
    }
}
