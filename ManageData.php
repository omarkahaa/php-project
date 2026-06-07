<?php

class ManageData
{
    const HOST = 'localhost';
    const USER = 'root';
    const PASSWORD = '';
    const DATABASE = 'flight_logbook_omar';

    private $con;

    public function __construct()
    {
        $this->con = new PDO(
            'mysql:host=' . self::HOST . ';dbname=' . self::DATABASE . ';charset=utf8mb4',
            self::USER,
            self::PASSWORD
        );

        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function executeQuery($query, $params = [])
    {
        $stmt = $this->con->prepare($query);
        $stmt->execute($params);
    }

    public function getData($query, $params = [], $singleData = false)
    {
        $stmt = $this->con->prepare($query);
        $stmt->execute($params);

        if ($singleData) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
