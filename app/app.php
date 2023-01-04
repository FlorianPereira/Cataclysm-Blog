<?php

namespace app;

use app\database;

class app
{
    const DB_NAME = 'Cataclysm';
    const DB_USER = 'root';
    const DB_PASS = '1234';
    const DB_HOST= 'db';

    private static $database;

    /** Connect to the database, and if already done, only return $database
     * @return app\database
     */
    public static function getDb(){
        if(self::$database === null){
            self::$database = new database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
        }

        return self::$database;
    }
}