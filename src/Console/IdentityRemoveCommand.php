<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IdentityRemoveCommand extends SearchServiceCommand
{
    protected function configure()
    {
        $this
            ->setName('identity:remove')
            ->setDescription('Removes the saved Acquia Search Service API identity.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $services = $this->getApplication()->getServiceManager();

        if ($services->getClient('search-service', 'search-service')) {
            $services->deleteServiceGroup('search-service');
            $output->writeln('Identity removed.');
        } else {
            $output->writeln('No identity stored, nothing to do.');
        }
    }
}