<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DeleteStopwordsCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('stopwords:delete')
            ->setDescription('Deletes the stopwords.txt if they were customized. Reverts to default configs.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getSearchServiceClient($output)->deleteStopwords();
        $this->renderJson($output, $response);
    }
}
