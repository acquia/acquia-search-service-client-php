<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateStopwordsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('stopwords:create')
            ->setDescription('Uploads the stopwords.txt file for an index')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        #$response = $this->getSearchServiceClient($output)->createIndexStopwords($payload);
        #$this->renderJson($output, $response);
    }
}
