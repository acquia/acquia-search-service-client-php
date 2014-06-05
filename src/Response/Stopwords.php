<?php

namespace Acquia\Search\API\Response;

class Stopwords extends \Acquia\Rest\Element
{
    /**
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * @return string
     */
    public function to_list() {
        if (!empty($this['stopwords'])) {
            $list = implode(PHP_EOL, $this['stopwords']);
            return $list;
        }
        return "";
    }
}