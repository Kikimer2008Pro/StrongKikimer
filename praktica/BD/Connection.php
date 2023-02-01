<?php

namespace BD;

class Connection 
{
    static function connect($config) 
    {
        if ( $config['BD_DRIVER'] == 'sqlite' ) {

            $dsn = "sqlite:" . $config['BD_PATH'];

            if ( !filesize($config['BD_PATH']) ) {
                throw new \Exception('There are no tables in the database!');
            }

            $config['BD_USER'] = null;
            $config['BD_PASSWORD'] = null;

        } else {
            $dsn = $config['BD_DRIVER'] . ":host=" . $config['BD_HOST'] . ";dbname=" . $config['BD_NAME'];
        }

        $opt = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        $pdo = new \PDO($dsn, $config['BD_USER'], $config['BD_PASSWORD'], $opt);

        return $pdo;
    }
}