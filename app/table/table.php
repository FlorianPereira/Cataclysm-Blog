<?php

namespace app\table;

use \app\app;

class table{

    protected static $table;

    private static function getTable(){
        if(static::$table === null){
            $class_name = explode('\\', get_called_class());
            static::$table = end($class_name);
        }else{
            return static::$table;
        }
    }

    public static function getData(){
        $class_name = get_called_class();
        $query = 'SELECT * FROM ' . static::getTable();
        return app::getDb()->query($query, $class_name);
    }

    /**
     * TODO : create getters to access variables
     */
    public function __get($key){
        $method = 'get' . ucfirst($key);
        $this->$key = $this->$method();

        return $this->$key;
    }




}