<?php

namespace Acquia\Search\API;

use Acquia\Rest\ServiceManagerAware;
use Guzzle\Service\Client;
use Guzzle\Common\Collection;


class SearchServiceClient extends Client implements ServiceManagerAware
{

    const BASE_URL  = 'https://api.acquia-search.com';

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
     * @return \Acquia\Search\API\Response\Ping
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function ping()
    {
        $request = $this->get('{+base_path}/ping');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Ping($request);
    }

    /**
     * Returns the stopwords for a given index
     *
     * @return \Acquia\Search\API\Response\Stopwords
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function stopwords()
    {
        $request = $this->get('{+base_path}/stopwords');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Stopwords($request);
    }

    /**
     * Deletes the stopwords for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function deleteStopwords()
    {
        $request = $this->delete('{+base_path}/stopwords');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Adds stopwords for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function createStopwords($stopwords)
    {
        if (empty($stopwords) || !is_array($stopwords)) {
            throw new \RuntimeException("Stopword lists can't be empty");
        }

        $payload = json_encode(array('stopwords' => $stopwords));
        $request = $this->post('{+base_path}/stopwords', null, $payload);
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Returns the protwords for a given index
     *
     * @return \Acquia\Search\API\Response\Protwords
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function protwords()
    {
        $request = $this->get('{+base_path}/protwords');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Protwords($request);
    }

    /**
     * Deletes the suggestions for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function deleteProtwords()
    {
        $request = $this->delete('{+base_path}/protwords');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Adds protwords for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function createProtwords($protwords)
    {
        if (empty($protwords) || !is_array($protwords)) {
            throw new \RuntimeException("Protected Words list can't be empty");
        }

        $payload = json_encode(array('protwords' => $protwords));
        $request = $this->post('{+base_path}/protwords', null, $payload);
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Returns the synonyms for a given index
     *
     * @return \Acquia\Search\API\Response\Synonyms
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function synonyms()
    {
        $request = $this->get('{+base_path}/synonyms');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Synonyms($request);
    }

    /**
     * Deletes the suggestions for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function deleteSynonyms()
    {
        $request = $this->delete('{+base_path}/synonyms');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Adds synonyms for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function createSynonyms($synonyms)
    {
        if (empty($synonyms) || !is_array($synonyms)) {
            throw new \RuntimeException("synonyms lists can't be empty");
        }
        $synonyms_payload = array();

        foreach ($synonyms as $synonym_raw) {
            // source synonyms need to have at least 1 child synonym.
            $synonym = explode(';', $synonym_raw);
            if (!isset($synonym[0])) {
                throw new \RuntimeException("Suggestions input could not be read or parsed. Please check your input.");
            }
            if (!isset($synonym[1])) {
                throw new \RuntimeException('Synonyms that are added need to have at least 1 synonym. Eg. "GB;Gigabyte". Word that we tripped on was ' . $synonym[0]);
            }
            if (preg_match('/\s/',$synonym[0])) {
                throw new \RuntimeException('The Parent Synonym word cannot have spaces');
            }
            $base_synonym = array_shift($synonym);

            $synonyms_payload += array($base_synonym => $synonym);
        }

        $payload = json_encode(array('synonyms' => $synonyms_payload));
        $request = $this->post('{+base_path}/synonyms', null, $payload);
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Returns the suggestions for a given index
     *
     * @return \Acquia\Search\API\Response\Suggestions
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function suggestions()
    {
        $request = $this->get('{+base_path}/suggestions');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Suggestions($request);
    }

    /**
     * Deletes the suggestions for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function deleteSuggestions()
    {
        $request = $this->delete('{+base_path}/suggestions');
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

    /**
     * Adds suggestions for a given index
     *
     * @return \Acquia\Search\API\Response\Message
     *
     * @throws \Guzzle\Http\Exception\ClientErrorResponseException
     */
    public function createSuggestions($suggestions)
    {
        if (empty($suggestions) || !is_array($suggestions)) {
            throw new \RuntimeException("Suggestions lists can't be empty");
        }
        $suggestions_payload = array();

        foreach ($suggestions as $suggestion_raw) {
            // suggestions need to have scores.
            $suggestion = explode(';', $suggestion_raw);
            // Add the score to 1.0 if score isn't present
            if (!isset($suggestion[0])) {
                throw new \RuntimeException("Suggestions input could not be read or parsed. Please check your input.");
            }
            if (!isset($suggestion[1])) {
                $suggestion[1] = "1.0";
            }
            $suggestions_payload[] = array('suggestion' => $suggestion[0], 'score' => $suggestion[1]);
        }

        $payload = json_encode(array('suggestions' => $suggestions_payload));
        $request = $this->post('{+base_path}/suggestions', null, $payload);
        $request->getQuery()->set('id', $this->getConfig('search_identifier'));
        return new Response\Message($request);
    }

}
