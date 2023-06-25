<?php
require_once 'db.php';

class Event
{
    private $connection;

    public function __construct()
    {
        $db = new Db();
        $this->connection = $db->getConnection();
    }

    public function getEventInfo($eventID)
    {
        $sql = "SELECT * FROM events WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $eventID, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insertEvent($name, $description, $event_date, $event_time, $host_id)
    {
        $sql = "INSERT INTO events (name, description, event_date, event_time, host_id) VALUES (:name, :description, :event_date, :event_time, :host_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':event_date', $event_date, PDO::PARAM_STR);
        $stmt->bindParam(':event_time', $event_time, PDO::PARAM_STR);
        $stmt->bindParam(':host_id', $host_id, PDO::PARAM_INT);       
        return $stmt->execute();
    }

    public function bindEventToInvitedUser($user_id, $event_id)
    {
        $sql = "INSERT INTO userevents (user_id, event_id) VALUES (:user_id, :event_id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getLastInsertedEventId()
    {
        return $this->connection->lastInsertId();
    }
}


?>