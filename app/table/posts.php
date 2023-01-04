<?php

namespace app\table;

use \app\app;

class posts extends table{

    private $id;
    public $title;
    public $author;
    public $content;
    public $date;
    public $tag_title;

    /** Connect to the database, then loop on all results from the SELECT query, and create an instance for each article
     * @return array|false|null
     */
    public static function getLast(){
        $query = 'SELECT p.id, title, author, content, date, tag_title 
                FROM posts p 
                INNER JOIN tags t ON p.id_tags = t.id';
        return app::getDb()->query($query, __CLASS__);
    }

    /**
     * TODO : create getters to access variables
     */
    public function __get($key){
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();

        return $this->$key;
    }

    /**Generate an URL for the article with it SQL id
     * @return string
     */
    public function getURL(){
        return 'index.php?p=article&id=' . $this->id;
    }

    /**Extract the content of the article from SQL content
     * @return mixed
     */

    public function getExtract(){
        $content = '<p>' . substr($this->content,0,200) . ' ...</p>';
        $content .= '<p><a href="' . $this->getURL() . '">Voir la suite</a></p>';
        $content .= '<p>Tags : ' . $this->tag_title . '</p>';
        $content .= '<p>Posté par ' . $this->author . ', le ' . $this->date . '.</p>';

        return $content;
    }
}