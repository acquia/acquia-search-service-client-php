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
        return hash_hmac('sha1', $content, $this->getSecretKey());
    }
}