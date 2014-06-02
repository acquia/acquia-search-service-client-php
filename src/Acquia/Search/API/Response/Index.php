<?php

namespace Acquia\Search\API\Response;

class Index extends \Acquia\Rest\Element
{
    /**
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * @return string
     */
    public function name()
    {
        return $this['name'];
    }

    /**
     * @return string
     */
    public function schema()
    {
        return $this['schema'];
    }

    /**
     * @return string
     */
    public function domain()
    {
        return $this['domain'];
    }
}