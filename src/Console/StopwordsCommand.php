<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StopwordsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('stopwords')
            ->setDescription('Returns the stopwords for an index if they were customized.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->stopwords();
        $this->renderJson($output, $response);
    }
}
