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
            ->setDescription('Replaces all the words that are protected from stemming. Eg. ')
            ->addProtwordsArgument()
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $protected_words  = $input->getArgument(self::PROTWORDS_ARGUMENT);
        $response = $this->getSearchServiceClient($output)->createProtwords($protected_words);
        $this->renderJson($output, $response);
    }
}
