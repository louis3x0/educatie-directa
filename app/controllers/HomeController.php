<?php

use MyApp\Controller;
use MyApp\Database;

/**
 * HomeController Class
 *
 * Represents the controller for the home-related functionality.
 */
class HomeController extends Controller
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getSubjects()
    {
        $this->db->query("SELECT * FROM materii_meditatii");
        $subjects = $this->db->resultSet();
        return $subjects;
    }

    public function getLocations()
    {
        $this->db->query("SELECT * FROM judete_romania");
        $locations = $this->db->resultSet();
        return $locations;
    }

    public function getParameters()
    {
        $params = [];
        if (isset($_GET['materie'])) {
            $params['materie'] = $_GET['materie'];
        }
        if (isset($_GET['locatie'])) {
            $params['locatie'] = $_GET['locatie'];
        }

        return $params;
    }

    public function getTeachers($params)
    {
        $this->db->query("SELECT * FROM profesori");
        $teachers = $this->db->resultSet();
        return $teachers;
    }
    
    /**
     * Display the index page.
     */
    public function index()
    {
        $subjects = $this->getSubjects();
        $locations = $this->getLocations();
        $params = $this->getParameters();

        $data['title'] = "Acasă - Educatie Directa - Caută profesorul potrivit";
        $data['subjects'] = $subjects;
        $data['locations'] = $locations;
        $data['teachers'] = $this->getTeachers($params);

        $this->template('header', $data);
        $this->template('navbar', $data);
        $this->view('home', $data);
        $this->template('footer');
    }
}
