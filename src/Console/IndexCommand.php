<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IndexCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('index')
            ->setAliases(array('index:info'))
            ->setDescription('Returns information about a search index.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->index();
        $this->renderJson($output, $response);
    }
}