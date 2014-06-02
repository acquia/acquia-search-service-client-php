<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ProtwordsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('protwords')
            ->setDescription('Returns the protwords for an index if they were customized.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->protwords();
        $this->renderJson($output, $response);
    }
}
