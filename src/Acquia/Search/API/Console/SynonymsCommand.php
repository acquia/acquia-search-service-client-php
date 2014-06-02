<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SynonymsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('synonyms')
            ->setDescription('Returns the synonyms for an index if they were customized.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->synonyms();
        $this->renderJson($output, $response);
    }
}
