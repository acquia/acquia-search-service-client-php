<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSuggestionsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('suggestions:create')
            ->setDescription('Uploads the suggestions.txt file for an index')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        #$response = $this->getSearchServiceClient($output)->createIndexSuggestions($payload);
        #$this->renderJson($output, $response);
    }
}
