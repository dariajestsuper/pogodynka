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
    name: 'GetWeatherLocationID',
    description: 'Add a short description for your command',
)]
class GetWeatherLocationIDCommand extends Command
{
    private WeatherUtil $weatherservice;
    private MeasurementRepositoty $measurement;
    private LocationRepository $location;

    public function __construct(WeatherUtil $weatherservice)
    {
        $this->weatherservice = $weatherservice;

        parent::__construct();
    }
    
    protected function configure(): void
    {
        $this
            ->addArgument('LocationID', InputArgument::REQUIRED, 'LocationID')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $locID = $input->getArgument('LocationID');
      
        $result = $this->weatherservice->getWeatherForLocation($locID);

        $output->writeln($result);

        return Command::SUCCESS;
    }
}