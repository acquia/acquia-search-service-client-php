<?php

namespace Acquia\Search\API;

use Acquia\Rest\SignatureAbstract;

class Signature extends SignatureAbstract
{
    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $url;

    /**
     * @param string $privateKey
     * @param string $method
     * @param string $url
     */
    public function __construct($privateKey)
    {
        $this->secretKey = $privateKey;
    }

    /**
     * @param string $content
     *
     * @return string
     */
    public function generate($content)
    {
        print "secret\n";
        print $this->getSecretKey();
        print "\ncanonical representation\n";
        print $content;
        $hash = hash_hmac('sha1', $content, $this->getSecretKey());
        print "\nHash\n";
        print $hash;
        return $hash;
    }
}