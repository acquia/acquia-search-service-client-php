<?php

namespace Acquia\Search\API;

use Guzzle\Common\Event;
use Guzzle\Http\Message\Request;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Http\Message\EntityEnclosingRequestInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Guzzle\Plugin\Oauth\OauthPlugin;

class SearchServiceAuthPlugin implements EventSubscriberInterface
{

    /**
     * @var string
     */
    protected $network_identifier;

    /**
     * @var string
     */
    protected $network_key;

    /**
     * @var string
     */
    protected $network_salt;

    /**
     * @var string
     */
    protected $search_identifier;

    /**
     * @param string $publicKey
     * @param string $privateKey
     */
    public function __construct($network_identifier, $network_key, $network_salt, $search_identifier)
    {
        $this->network_identifier = $network_identifier;
        $this->network_key = $network_key;
        $this->network_salt = $network_salt;
        $this->search_identifier = $search_identifier;
    }

    /**
     * @return string
     */
    public function getNetworkIdentifier()
    {
        return $this->network_identifier;
    }

    /**
     * @return string
     */
    public function getNetworkKey()
    {
        return $this->network_key;
    }

    /**
     * @return string
     */
    public function getNetworkSalt()
    {
        return $this->network_salt;
    }

    /**
     * @return string
     */
    public function getSearchIdentifier()
    {
        return $this->search_identifier;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            'request.before_send' => array('onRequestBeforeSend', -1000)
        );
    }

    /**
     * Request before-send event handler.
     *
     * @param \Guzzle\Common\Event $event
     */
    public function onRequestBeforeSend(Event $event)
    {
        $this->signRequest($event['request']);
    }

    /**
     * @param \Guzzle\Http\Message\Request $request
     */
    public function signRequest(Request $request)
    {

        // Add the method to the sign string
        $sign = $request->getMethod() . "\n";

        // Fix the date and add it to the sign string
        if ($request->hasHeader('Date')) {
            $sign .= $request->getHeader('Date') . '\n';
        } else {
            $date = gmdate("D, d M Y H:i:s", time())." GMT";
            $request->setHeader('Date',$date);
            $sign .= "date:" . $date . "\n";
        }

        // Fix the nonce and add it to the sign string
        if ($request->hasHeader('X-MAC-Nonce')) {
            $sign .= $request->getHeader('X-MAC-Nonce') . "\n";
        } else {
            $nonce = hash('sha1', $this->makeRandomString(256));
            $request->setHeader('X-HMAC-Nonce',$nonce);
            $sign .= "nonce:" . $nonce . "\n";
        }

        // Add the body of the request if a body is present
        if ($request instanceof EntityEnclosingRequestInterface && ($request->getMethod() == 'POST' || $request->getMethod() == 'PUT' || $request->getMethod() == 'PATCH')) {
            $md5 = $request->getBody()->getContentMd5(true,true);
            $sign .= "content-md5:" . $md5 . "\n";
            $sign .= "content-type:" . $request->getHeader('Content-Type') . "\n";
            $request->setHeader('Content-MD5',$md5);
        } else {
            $request->removeHeader('Content-MD5');
            $request->removeHeader('Content-Type');
        }

        // Add the URL
        $sign .= $request->getResource();

        // The concatenation that is needed to generate our derived key. Predefined syntax
        $derivation_string = $this->getSearchIdentifier() . 'solr' . $this->getNetworkSalt();

        // The derived key generated from the information given by Acquia.
        $derived_key = hash_hmac('sha1', str_pad($derivation_string, 80, $derivation_string), $this->getNetworkKey());

        $signature = new Signature($derived_key);
        $hash = $signature->generate($sign);

        $request->setHeader('Authorization', "HMAC " . $hash);

    }

    /**
     * Generates a random string for use in a nonce.
     *
     * @param int $bits
     * @return string
     */
    private function makeRandomString($bits = 256) {
        $bytes = ceil($bits / 8);
        $return = '';
        for ($i = 0; $i < $bytes; $i++) {
            $return .= chr(mt_rand(0, 255));
        }
        return $return;
    }
}