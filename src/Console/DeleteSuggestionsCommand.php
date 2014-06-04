<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteSuggestionsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('suggestions:delete')
            ->setDescription('Deletes the suggestions.txt if they were customized. Reverts to default configs.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->deleteSuggestions();
        $this->renderJson($output, $response);
    }
}
