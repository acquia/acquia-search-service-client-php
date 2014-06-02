<?php

namespace Acquia\Search\API;

use Acquia\Rest\ServiceManagerAware;
use Guzzle\Plugin\Md5\CommandContentMd5Plugin;
use Guzzle\Service\Client;
use Guzzle\Common\Collection;
use SebastianBergmann\PHPCPD\CLI\Command;


class SearchServiceClient extends Client implements ServiceManagerAware
{

    const BASE_URL  = 'http://localhost:5000';

    /**
     * A method used to test whether this class is autoloaded.
     *
     * @return bool
     *
     * @see \Acquia\Search\API\Test\DummyTest
     */
    public function autoloaded()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * http(s)://api.acquia-search.com
     *
     * @return \Acquia\Search\API\SearchServiceClient
     */
    public static function factory($config = array())
    {
        $required = array(
            'base_url',
            'search_identifier',
            'network_identifier',
            'network_key',
            'network_salt',
        );

        $defaults = array(
            'base_url' => self::BASE_URL,
        );

        // Instantiate the Acquia Search Service plugin.
        $config = Collection::fromConfig($config, $defaults, $required);
        $client = new static($config->get('base_url'), $config);

        $headers = array(
            'Content-Type' => 'application/json; charset=UTF-8',
        );
        $client->setDefaultHeaders($headers);

        // Attach the Acquia Search plugin to the client.
        $search_service_auth = new SearchServiceAuthPlugin($config->get('network_identifier'), $config->get('network_key'), $config->get('network_salt'), $config->get('search_identifier'));
        $client->addSubscriber($search_service_auth);

        return $client;
    }

    /**
     * {@inheritdoc}
     */
    public function getBuilderParams()
    {
        return array(
            'base_url'    => $this->getConfig('base_url'),
            'search_identifier'  => $this->getConfig('search_identifier'),
            'network_key'  => $this->getConfig('network_key'),
            'network_identifier' => $this->getConfig('network_identifier'),
            'network_salt' => $this->getConfig('network_salt'),
        );
    }

    /**
     * Returns basic index information for the given index
     *
     * @return \Acquia\Search\API\Response\Index
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function index()
    {
        $request = $this->get('{+base_path}/index');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Index($request);
    }

    /**
     * Returns basic index information for the given index
     *
     * @return \Acquia\Search\API\Response\Index
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function ping()
    {
        $request = $this->get('{+base_path}/ping');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Ping($request);
    }

}
