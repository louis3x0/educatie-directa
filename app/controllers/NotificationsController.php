<?php

namespace Notifications;

use MyApp\Controller;
use MyApp\Database;

/**
 * HomeController Class
 *
 * Represents the controller for the home-related functionality.
 */
class NotificationsController extends Controller
{
    /**
     * Display the logion page.
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    
    public function getUserNotifications($userId){
        $sql = "SELECT * FROM notifications WHERE user_id = ?";
        $this->db->query($sql);
        $this->db->bind(1, $userId);
        $notifications = $this->db->resultSet();
        return $notifications;
    }

    public function create($userId, $message){
        $sql = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
        $this->db->query($sql);
        $this->db->bind(1, $userId);
        $this->db->bind(2, $message);
        return $this->db->execute();
    }

    public function list($userId){
        $sql = "SELECT * FROM notifications WHERE user_id = ?";
        $this->db->query($sql);
        $this->db->bind(1, $userId);
        $notifications = $this->db->resultSet();
        return $notifications;
    }
}

?>