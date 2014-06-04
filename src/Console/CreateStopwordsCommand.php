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
            ->setDescription('Generates a stopwords file for the given index')
            ->addStopwordsArgument()
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $stopwords  = $input->getArgument(self::STOPWORDS_ARGUMENT);
        $response = $this->getSearchServiceClient($output)->createStopwords($stopwords);
        $this->renderJson($output, $response);
    }
}
