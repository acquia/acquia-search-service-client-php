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
            $list = "";
            foreach ($this['synonyms'] as $synonym_parent => $synonym_childs) {
                $list .= $synonym_parent . ';' . implode(';', $synonym_childs) . PHP_EOL;
            }
            return $list;
        }
        return "";
    }

}