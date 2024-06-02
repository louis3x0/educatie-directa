<?php

use MyApp\Controller;
use MyApp\Database;

/**
 * HomeController Class
 *
 * Represents the controller for the home-related functionality.
 */
class AuthController extends Controller
{
    /**
     * Display the logion page.
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    public function create($fullName, $password, $email, $phone, $sex, $role, $terms_and_conditions_accepted)
    {
        if (!$fullName || !$password || !$email || !$phone || !$sex || !$role || !$terms_and_conditions_accepted) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }
    
        // Password hashing for security
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        // Prepare SQL statement to insert the new user
        $sql = "INSERT INTO users (full_name, password, email, phone, sex, role, terms_and_conditions_accepted) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        // Use the query method to prepare the statement
        $this->db->query($sql);

        $params = [$fullName, $hashedPassword, $email, $phone, $sex, $role, $terms_and_conditions_accepted];
        foreach ($params as $index => $param) {
            $this->db->bind($index + 1, $param);
        }
    
        // Execute the statement and check for errors
        if ($this->db->execute()) {
            $this->component('toaster', ['message' => 'User registered successfully.']);
            header('refresh:1.5;url=' . BASEURL . '/login');
        } else {
            $this->component('toaster', ['message' => 'An error occurred. Please try again.']);
        }
    }

    public function authenticate($email, $password)
    {
        if (!$email || !$password) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }

        // Prepare SQL statement to fetch the user by email
        $sql = "SELECT * FROM users WHERE email = ?";
        
        // Use the query method to prepare the statement
        $this->db->query($sql);

        $this->db->bind(1, $email);
        
        // Execute the statement and check for errors
        $user = $this->db->single();
        
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['full_name'] = $user['full_name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                $this->component('toaster', ['message' => 'Utilizator autentificat cu succes.']);

                header('refresh:1.5;url=' . BASEURL);
            } else {
                $this->component('toaster', ['message' => 'Email sau parolă incorectă.']);
            }
        } else {
            $this->component('toaster', ['message' => 'Utilizatorul nu există.']);
        }
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
            'description' => 'This is the login page',
            'styles' => [
                'login.css'
            ],
        ];
        $this->template('header', $data);
        $this->template('navbar', $data);
        $this->view('login');
        $this->template('footer');
    }

    public function register()
    {
        $data = [
            'title' => 'Login',
            'description' => 'This is the login page',
            'styles' => [
                'login.css'
            ],
        ];
        $this->template('header', $data);
        $this->template('navbar', $data);
        $this->view('register');
        $this->template('footer');
    }

    public function logout()
    {
        // Unset all session variables
        session_unset();

        // Destroy the session
        session_destroy();

        // Delete the session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Redirect to the login page
        header('Location: /login');
    }
}
