<?php

namespace Acquia\Search\API\Console;

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Output\OutputInterface;
use Acquia\Json\Json;

class JsonHelper extends Helper
{
    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param array $data
     */
    public function render(OutputInterface $output, $data)
    {
        $output->writeln(Json::encode($data));
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'json';
    }
}