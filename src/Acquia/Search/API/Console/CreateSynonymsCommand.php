<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateSynonymsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('synonyms:create')
            ->setDescription('Uploads the synonyms.txt file for an index')
            ->addSynonymsArgument()
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $synonyms  = $input->getArgument(self::SYNONYMS_ARGUMENT);
        $response = $this->getSearchServiceClient($output)->createSynonyms($synonyms);
        $this->renderJson($output, $response);
    }
}
