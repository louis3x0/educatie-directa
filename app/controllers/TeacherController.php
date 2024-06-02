<?php

use MyApp\Controller;
use MyApp\Database;
use Notifications\NotificationsController;

/**
 * HomeController Class
 *
 * Represents the controller for the home-related functionality.
 */
class TeacherController extends Controller
{
    public function getParameters()
    {
        $params = [];
        if (isset($_GET['url'])) {
            $urlParts = explode('/', $_GET['url']);
            if (count($urlParts) >= 3) {
                $params['materie'] = $urlParts[1];
                $params['locatie'] = $urlParts[2];
            }
        }

        return $params;
    }
    public function getTeachers($params)
    {
        $materie = $params['materie'];
        $locatie = $params['locatie'];
    
        $this->db->query("SELECT * FROM profesori WHERE materia = :materie AND locatie = :locatie");
        $this->db->bind(':materie', $materie);
        $this->db->bind(':locatie', $locatie);
    
        $teachers = $this->db->resultSet();
        return $teachers;
    }

    // get judete_romania table and materii_meditatii
    public function getJudete()
    {
        $this->db->query("SELECT * FROM judete_romania");
        $judete = $this->db->resultSet();
        return $judete;
    }

    public function getMaterii()
    {
        $this->db->query("SELECT * FROM materii_meditatii");
        $materii = $this->db->resultSet();
        return $materii;
    }
    
    /**
     * Display the logion page.
     */
    public function index()
    {
        $data = [
            'title' => 'Login',
            'description' => 'This is the login page',
            'styles' => [
                'teacher.css'
            ],
        ];
        $this->template('header', $data);
        $this->template('navbar', $data);
        $this->view('mediator-details');
        $this->template('footer');
    }

    public function search()
    {
        $params = $this->getParameters();
        $data = [
            'title' => 'Login',
            'description' => 'This is the login page',
            'styles' => [
                'teacher.css'
            ],
        ];
        $data['teachers'] = $this->getTeachers($params);
        $data['judete'] = $this->getJudete();
        $data['materii'] = $this->getMaterii();
        $data['params'] = $params;

        $this->template('header', $data);
        $this->template('navbar', $data);
        $this->view('search', $data);
        $this->template('footer');
    }
    
    public function applyForMediation($userId, $teacherId)
    {
        if (!$userId || !$teacherId) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }
    
        // Prepare SQL statement to insert the new application
        $sql = "INSERT INTO applications (user_id, status, teacher_id) VALUES (?, 'pending', ?)";
        
        // Prepare the SQL statement
        $this->db->query($sql);
    
        // Bind the parameters
        $this->db->bind(1, $userId);
        $this->db->bind(2, $teacherId);
    
        // Execute the statement and check for errors
        if ($this->db->execute()) {
            $this->component('toaster', ['message' => 'Application for mediation submitted successfully.']);

            // send notification to teacher
            $notifications = new NotificationsController();

            $message = "O nouă cerere de mediere a fost trimisă de un student. Te rugăm să revizuiești cererea și să răspunzi în consecință.";
            
            $notifications->create($teacherId, $message);
        } else {
            $this->component('toaster', ['message' => 'An error occurred. Please try again.']);
        }
    }

    public function checkIfUserApplied($userId, $teacherId)
    {
        if (!$userId || !$teacherId) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }

        // Prepare SQL statement to check if the user already applied for mediation
        $sql = "SELECT * FROM applications WHERE user_id = ? AND teacher_id = ?";
        
        // Prepare the SQL statement
        $this->db->query($sql);
    
        // Bind the parameters
        $this->db->bind(1, $userId);
        $this->db->bind(2, $teacherId);
    
        // Execute the statement and check for errors
        $application = $this->db->single();
        return $application;
    }
}
