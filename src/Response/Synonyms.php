<?php

namespace Acquia\Search\API\Response;

class Synonyms extends \Acquia\Rest\Element
{
    /**
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * @return string
     */
    public function to_list() {
        if (!empty($this['synonyms'])) {
            $list = implode(PHP_EOL, $this['synonyms']);
            return $list;
        }
        return "";
    }

}