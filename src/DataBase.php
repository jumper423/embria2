<?php

namespace jumper423;

class DataBase
{
    /**
     * @var \PDO
     */
    private $db;
    private static $instance = null;

    /**
     * @param string $database
     * @param string $user
     * @param string $password
     * @param string $host
     * @param int $port
     * @return $this
     */
    public static function connect(string $database, string $user, string $password, $host = 'localhost', $port = 3306)
    {
        if (is_null(self::$instance)) {
            self::$instance = new DataBase(new \PDO(
                "mysql:host=$host;port=$port;dbname=$database",
                $user,
                $password
            ));
        }
        return self::$instance;
    }

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function row(string $string)
    {
        $stmt = $this->db->prepare($string);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_LAZY);
    }
}