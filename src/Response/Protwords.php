<?php

namespace Acquia\Search\API\Response;

class Protwords extends \Acquia\Rest\Element
{
    /**
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * @return string
     */
    public function to_list() {
        if (!empty($this['protwords'])) {
            $list = implode(PHP_EOL, $this['protwords']);
            return $list;
        }
        return "";
    }

}