<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location;
use App\Repository\MeasurementRepository;

class WeatherController extends AbstractController
{
    public function cityAction(Location $id, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($id);

        return $this->render('weather/city.html.twig', [
            'location' => $id,
            'measurements' => $measurements,
        ]);
    }
}
