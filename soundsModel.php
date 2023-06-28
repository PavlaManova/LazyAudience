<?php
require_once './db.php';

class SoundDB
{
    private $connection;

    public function __construct()
    {
        $db = new Db();
        $this->connection = $db->getConnection();
    }
}


?>