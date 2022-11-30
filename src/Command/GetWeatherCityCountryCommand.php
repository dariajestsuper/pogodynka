<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use App\Service\WeatherUtil;

#[AsCommand(
    name: 'GetWeatherCityCountry',
    description: 'Add a short description for your command',
)]
class GetWeatherCityCountryCommand extends Command
{
    private WeatherUtil $weatherservice;

    public function __construct(WeatherUtil $weatherservice, string $name = null)
    {
        $this->weatherservice = $weatherservice;

        parent::__construct($name);
    }

    protected function configure(): void
    {
        $this
            ->addArgument('city', null, InputArgument::REQUIRED, 'city')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $city = $input->getArgument('city');
        $result = $this->weatherservice->getWeatherForCountryAndCity($city);

        $output->writeln($result);


        return Command::SUCCESS;
    }
}
