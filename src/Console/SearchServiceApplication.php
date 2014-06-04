<?php

namespace Acquia\Search\API\Console;

use Acquia\Rest\ServiceManager;
use Symfony\Component\Console\Application;

class SearchServiceApplication extends Application
{
    /**
     * @var \Acquia\Rest\ServiceManager
     */
    protected $services;

    /**
     * {@inheritdoc}
     */
    public function __construct(ServiceManager $services)
    {
        parent::__construct('Acquia Search Service', 'self.version');
        $this->services = $services;
    }

    /**
     * @return \Acquia\Rest\ServiceManager
     */
    public function getServiceManager()
    {
        return $this->services;
    }
}