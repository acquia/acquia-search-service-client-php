<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteSynonymsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('synonyms:delete')
            ->setDescription('Deletes the stopwords.txt if they were customized. Reverts to default configs.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->deleteSynonyms();
        $this->renderJson($output, $response);
    }
}
