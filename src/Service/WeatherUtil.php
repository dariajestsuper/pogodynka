<?php
namespace App\Service;

use App\Repository\MeasurementRepository;
use App\Repository\LocationRepository;
use App\Entity\Location;

class WeatherUtil {

    private MeasurementRepository $measuresRepository;
    private LocationRepository $locationRepository;

    public function __construct(MeasurementRepository $measurementRepository, LocationRepository $locationRepository)
    {
        $this->measurementRepository = $measurementRepository;
        $this->locationRepository = $locationRepository;
    }

    public function getWeatherForCountryAndCity($city)
    {
        $location = $this->locationRepository->findByLocation($city);
        $locid = $this->locationRepository->getId($location);
        $measurements = $this->getWeatherForLocation($locid);
        $result = ["location" => $city, "measurements" => $measurements];

        return $result;
    }
   
    public function getWeatherForLocation($location)
    {
        $measurements = $this->measurementRepository->findByLocation($location);

        return $measurements;
    }
}
?>