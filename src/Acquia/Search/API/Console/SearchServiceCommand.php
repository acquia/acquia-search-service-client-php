<?php

namespace Acquia\Search\API\Console;

use Acquia\Search\API\SearchServiceClient;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

class SearchServiceCommand extends Command
{
    const INDEX_ARGUMENT      = 'indexId';
    const FILEPATH_ARGUMENT   = 'filepath';

    /**
     * @var \Acquia\Search\API\SearchServiceClient
     */
    protected $searchServiceClient;

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return \Acquia\Search\API\SearchServiceClient
     */
    public function getSearchServiceClient(OutputInterface $output)
    {
        $services = $this->getApplication()->getServiceManager();
        $search_service = $services->getClient('search-service', 'search-service');

        if (!$search_service) {
            $config = $this->promptIdentity($output);
            $search_service = SearchServiceClient::factory($config);
            $services->setClient('search-service', 'search-service', $search_service);
            $services->saveServiceGroup('search-service');
        }

        return $search_service;
    }

    /**
     * @param string $filepath
     *
     * @throws \RuntimeException
     */
    public function readFiledata($filepath)
    {
        if (!is_file($filepath)) {
            throw new \RuntimeException('File not found: ' . $filepath);
        } elseif (!is_writable($filepath)) {
            throw new \RuntimeException('File not readable: ' . $filepath);
        }
        return file_get_contents($filepath);
    }

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return array
     */
    public function promptIdentity(OutputInterface $output)
    {
        $dialog = $this->getHelperSet()->get('dialog');
        return array(
            'network_identifier' => $dialog->ask($output, 'Network Identifier: '),
            'network_key' => $dialog->askHiddenResponse($output, 'Network key: '),
            'network_salt' => $dialog->askHiddenResponse($output, 'Network salt: '),
            'search_identifier' => $dialog->ask($output, 'Search Index Identifier: '),
        );
    }

    /**
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param array $data
     */
    public function renderJson(OutputInterface $output, $data)
    {
        $helperSet = $this->getApplication()->getHelperSet();
        if (!$helperSet->has('json')) {
            $helperSet->set(new JsonHelper());
        }
        $helperSet->get('json')->render($output, $data);
    }

    /**
     * @return \Acquia\Search\API\Console\SearchServiceCommand
     */
    public function addFilepathArgument()
    {
        return $this->addArgument(
            self::FILEPATH_ARGUMENT,
            InputArgument::REQUIRED,
            'The path to the configuration file'
        );
    }
}