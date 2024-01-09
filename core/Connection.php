<?php

use FTP\Connection as FTPConnection;

class Connection
{
    private static $instance = null, $conn = null;
    private function __construct($config)
    {
        // connect database
        try {
            // cau hinh dsn
            $dsn = 'mysql:dbname=' . $config['db'] . ';host=' . $config['host'];

            $options = [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            // Cau lenh ket noi
            $pass = isset($config['pass']) ? $config['pass'] : '';
            $con = new PDO($dsn, $config['user'], $pass, $options);
            self::$conn = $con;
        } catch (Exception $exception) {
            $mess = $exception->getMessage();
            die();
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            $connection = new Connection($config);
            self::$instance = self::$conn;
        }
        return self::$instance;
    }
}
