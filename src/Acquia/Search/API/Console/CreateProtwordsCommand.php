<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateProtwordsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('protwords:create')
            ->setDescription('Uploads the protwords.txt file for an index')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        #$response = $this->getSearchServiceClient($output)->createIndexProtwords($payload);
        #$this->renderJson($output, $response);
    }
}
