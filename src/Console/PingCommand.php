<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PingCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('ping')
            ->setAliases(array('index:ping'))
            ->setDescription('Returns information about a search ping.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->ping();
        $this->renderJson($output, $response);
    }
}