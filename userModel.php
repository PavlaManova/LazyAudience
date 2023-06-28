<?php
require_once './db.php';

class User
{
    private $connection;

    public function __construct()
    {
        $db = new Db();
        $this->connection = $db->getConnection();
    }

    public function getUserInfo($username)
    {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insertUser($username, $password, $email, $avatar_img_path)
    {
        $sql = "INSERT INTO users (username, password, email, avatar_img_path) VALUES (:username, :password, :email, :avatar_img_path)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(':password', $hash_password, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':avatar_img_path', $avatar_img_path, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public function checkUserExists($username, $email)
    {
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = :username OR email = :email";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['count'] > 0;
    }

    public function fetchAllUsersForInvitation($username)
    {
        $sql = "SELECT * FROM users WHERE id <> :id ORDER BY user_points DESC;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $this->getUserInfo($username)['id'], PDO::PARAM_INT);
        $stmt->execute();
        $usersInfo = $stmt->fetchAll();
        return $usersInfo;
    }

    public function fetchAllHostedEvents($user_id)
    {
        $sql = "SELECT * FROM events WHERE host_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $usersInfo = $stmt->fetchAll();
        return $usersInfo;
    }

    public function fetchAllGuestEvents($user_id)
    {
        $sql = "SELECT * FROM events WHERE id IN (SELECT event_id FROM userevents WHERE user_id = :id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $usersInfo = $stmt->fetchAll();
        return $usersInfo;
    }

    public function getUserSoundsCategories($user_id)
    {
        $sql = "SELECT category FROM sounds WHERE id IN (SELECT sound_id from usersounds WHERE user_id = :id)";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllSoundsFromCategory($user_id, $category)
    {
        $sql = "SELECT * FROM sounds WHERE id IN (SELECT sound_id from usersounds WHERE user_id = :id) AND category = :category";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updatePoints($user_id, $new_points)
    {
        $sql = "UPDATE users SET user_points = :new_points WHERE id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':new_points', $new_points, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllNotOwnedSounds($user_id, $category)
    {
        $sql = "SELECT * FROM sounds WHERE id NOT IN (SELECT sound_id from usersounds WHERE user_id = :id) AND category = :category";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll();
    }

}


?>