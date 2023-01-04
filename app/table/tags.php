<?php

namespace app\table;

use app\database;

class tags extends table{

    protected static $table = 'tags';
    public $id;
    public $tag_title;

    /**Generate an URL for the article with it SQL id
     * @return string
     */
    public function getURL(){
        return 'index.php?p=tags&id=' . $this->id;
    }

}