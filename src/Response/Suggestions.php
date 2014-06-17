<?php

namespace Acquia\Search\API\Response;

class Suggestions extends \Acquia\Rest\Element
{
    /**
     * @var string
     */
    protected $idColumn = 'id';

    /**
     * @return string
     */
    public function to_list() {
        $list = "";
        if (isset($this['suggestions'])) {
            foreach($this['suggestions'] as $suggestion) {
                $list .= $suggestion['suggestion'] . ";" . $suggestion['score'] . PHP_EOL;
            }
        }
        return $list;
    }

}