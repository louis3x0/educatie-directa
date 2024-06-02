<?php

use MyApp\Controller;
use MyApp\Database;

/**
 * HomeController Class
 *
 * Represents the controller for the home-related functionality.
 */
class AdminController extends Controller
{
    /**
     * Display the logion page.
     */
    public function __construct()
    {
        $this->db = new Database;
    }

    public function index()
    {
        $data = [
            'title' => 'Admin Panel',
            'styles' => ['admin.css'],
        ];

        $this->template('header', $data);
        $this->template('navbar', $data);
        $this->template('footer', $data);

        $this->view('admin/index');
    }

    public function loginIndex()
    {
        $data = [
            'title' => 'Admin Panel',
            'email' => '',
            'password' => '',
            'styles' => ['admin.css'],
        ];

        $this->template('header', $data);

        $this->view('admin/login');
    }


    public function login($email, $password)
    {
        if (!$email || !$password) {
            return ['success' => false, 'message' => 'All fields are required.'];
        }

        // Fetch the user record based on the email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $stmt = $this->db->queryVuln($sql);
        $user = $stmt->fetch();

        if ($user) {
            // Verify the password against the hash stored in the database
            if (password_verify($password, $user['password'])) {
                if ($user['role'] == 'admin') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['full_name'] = $user['full_name'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['role'] = $user['role'];

                    $this->component('toaster', ['message' => 'Utilizator autentificat cu succes.']);

                    header('refresh:1.5;url=' . BASEURL);
                    exit;
                } else {
                    $this->component('toaster', ['message' => 'Email sau parolă incorectă.']);
                }
            } else {
                $this->component('toaster', ['message' => 'Email sau parolă incorectă.']);
            }
        } else {
            $this->component('toaster', ['message' => 'Utilizatorul nu există.']);
        }
    }

    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->queryVuln($sql);
        return $stmt->fetchAll();
    }

    // delete
    public function delete($id)
    {
        $sql = "DELETE FROM users WHERE id = $id";
        $stmt = $this->db->queryVuln($sql);

        if ($stmt) {
            $this->component('toaster', ['message' => 'Utilizatorul a fost șters cu succes.']);
        } else {
            $this->component('toaster', ['message' => 'Eroare la ștergere.']);
        }

        header('refresh:1.5;url=' . BASEURL . '/admin');
        exit;
    }

    public function getJudete()
    {
        $sql = "SELECT * FROM judete_romania";
        $stmt = $this->db->queryVuln($sql);
        return $stmt->fetchAll();
    }

    public function getMaterii()
    {
        $sql = "SELECT * FROM materii_meditatii";
        $stmt = $this->db->queryVuln($sql);
        return $stmt->fetchAll();
    }

    public function addMaterie($materie, $categorie)
    {
        $sql = "INSERT INTO materii_meditatii (nume_materie, categorie) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$materie, $categorie]);
    
        if ($stmt) {
            $this->component('toaster', ['message' => 'Materie adăugată cu succes.']);
        } else {
            $this->component('toaster', ['message' => 'Eroare la adăugare.']);
        }
        
        exit;
    }

    public function addJudet($judet)
    {
        $sql = "INSERT INTO judete_romania (nume_judet) VALUES ('$judet')";
        $stmt = $this->db->queryVuln($sql);

        if ($stmt) {
            $this->component('toaster', ['message' => 'Județ adăugat cu succes.']);
        } else {
            $this->component('toaster', ['message' => 'Eroare la adăugare.']);
        }

        exit;
    }

    public function deleteJudet($id)
    {
        $sql = "DELETE FROM judete_romania WHERE id = $id";
        $stmt = $this->db->queryVuln($sql);

        if ($stmt) {
            $this->component('toaster', ['message' => 'Județ șters cu succes.']);
        } else {
            $this->component('toaster', ['message' => 'Eroare la ștergere.']);
        }

        header('refresh:1.5;url=' . BASEURL . '/admin');
        exit;
    }

    public function deleteMaterie($id)
    {
        $sql = "DELETE FROM materii_meditatii WHERE id = $id";
        $stmt = $this->db->queryVuln($sql);

        if ($stmt) {
            $this->component('toaster', ['message' => 'Materie ștearsă cu succes.']);
        } else {
            $this->component('toaster', ['message' => 'Eroare la ștergere.']);
        }

        header('refresh:1.5;url=' . BASEURL . '/admin');
        exit;
    }
}
