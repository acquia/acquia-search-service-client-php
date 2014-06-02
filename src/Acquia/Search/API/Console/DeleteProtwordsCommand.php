<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteProtwordsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('protwords:delete')
            ->setDescription('Deletes the protwords.txt if they were customized. Reverts to default configs.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->deleteProtwords();
        $this->renderJson($output, $response);
    }
}
