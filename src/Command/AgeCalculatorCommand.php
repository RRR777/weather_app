<?php

namespace App\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AgeCalculatorCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setDescription('Calculate the age')
            ->addArgument('date', InputArgument::REQUIRED, 'Birthday date, exp: 2012-10-15')
            ->addOption('adult', null, InputOption::VALUE_NONE, 'Are You adult?')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $date = $input->getArgument('date');
        $age = $this->getContainer()->get('services.service_manager')->calculateAge(new \DateTime ($date));

        if ($age) {
            $io->note(sprintf('I\'m %s years old.', $age));
        }

        $isAdult = $this->getContainer()->get('services.service_manager')->checkAge($age);
        if ($input->getOption('adult')) {
            $isAdult ? $io->success('Am I an adult? ---- YES !!!') : $io->warning('Am I an adult? ---- NO !!!');
        }
    }
}
