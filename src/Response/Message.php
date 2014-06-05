<?php

namespace Acquia\Search\API\Response;

class Message extends \Acquia\Rest\Element
{
    /**
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * @return string
     */
    public function message() {
        return $this['message'];
    }



}