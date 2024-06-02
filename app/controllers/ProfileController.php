<?php

use MyApp\Controller;
use MyApp\Database;

/**
 * HomeController Class
 *
 * Represents the controller for the home-related functionality.
 */
class ProfileController extends Controller
{
    /**
     * Display the logion page.
     */
    public function index()
    {
        $data = [
            'title' => 'Login',
            'description' => 'This is the login page',
            'styles' => [
                'user.css'
            ],
        ];

        $this->template('header', $data);
        $this->template('navbar', $data);
        $dataProfile = $this->getUserData();
        $role = $_SESSION['role'];

        if ($role == 'student') {
            $this->user('profile', $dataProfile);
        } elseif ($role == 'tutor') {
            $this->user('teacher', $dataProfile);
        }
        $this->template('footer');
    }

    // sessions
    public function sessions()
    {
        $data = [
            'title' => 'Session',
            'description' => 'This is the session page',
            'styles' => [
                'user.css'
            ],
        ];

        $this->template('header', $data);
        $this->template('navbar', $data);

        $this->user('sessions', $data);

        $this->template('footer');
    }

    public function getUserData()
    {
        $this->db->query("SELECT id, full_name, email, phone, sex, profile_picture, role FROM users WHERE id = :id");
        $this->db->bind(':id', $_SESSION['user_id']);

        $user = $this->db->single();
        return $user;
    }
    public function getUserApplications($userId)
    {
        $sql = "SELECT 
                    u.id AS teacher_id,
                    u.full_name AS teacher_name,
                    u.email AS teacher_email,
                    u.phone AS teacher_phone,
                    u.role AS teacher_role,
                    a.status AS application_status,
                    a.details AS application_details,
                    a.applied_at AS application_date
                FROM
                    applications a
                JOIN
                    users u ON a.teacher_id = u.id
                WHERE
                    a.user_id = ?";

        $this->db->query($sql);
        $this->db->bind(1, $userId);
        $results = $this->db->resultSet();

        return $results;
    }

    public function getTeacherApplications($teacherId)
    {
        // SQL query to fetch application data for a given teacher
        $sql = "SELECT 
            u.id AS user_id,
            u.full_name AS teacher_name,
            u.email AS teacher_email,
            u.phone AS teacher_phone,
            a.id AS application_id,
            a.status AS application_status,
            a.details AS application_details,
            a.applied_at AS application_date
        FROM 
            applications a
        JOIN 
        users u ON a.user_id = u.id
            WHERE 
            a.teacher_id = ? AND u.role = 'student'";

        // Prepare the query using your database class's query method
        $this->db->query($sql);
        // Bind the teacherId to the placeholder in the SQL query
        $this->db->bind(1, $teacherId);
        // Execute the query and store the results
        $results = $this->db->resultSet();
        // Return the results
        return $results;
    }

    public function updateApplicantStatus($applicationId, $teacherId, $status)
    {
        // Prepare SQL statement to update the application status
        $sql = "UPDATE applications SET status = ? WHERE user_id = ?";

        //
        // update the application status

        // Prepare the SQL statement
        $this->db->query($sql);

        // Bind the parameters
        $this->db->bind(1, $status);
        $this->db->bind(2, $applicationId);
        // Execute the statement and check for errors

        if ($this->db->execute()) {
            // get teacher application
            $this->component('toaster', ['message' => 'Application status updated successfully.']);
        } else {
            $this->component('toaster', ['message' => 'An error occurred. Please try again.']);
        }
    }

    public function findTeacherDetails($teacherId)
    {
        $sql = "SELECT 
                    u.id AS teacher_id,
                    u.nume AS nume,
                    u.experienta AS experienta,
                    u.ocupatie AS ocupatie,
                    u.studii AS studii,
                    u.calificari AS calificari,
                    u.materia AS materia,
                    u.pretsedinta AS pretsedinta,
                    u.numartelefon AS numartelefon,
                    u.descriere AS descriere,
                    u.locatie AS locatie,
                    u.datainscriere AS DataInscrie,
                    u.numarrecenzii AS NumarRecenzii,
                    u.numarrecomandari AS NumarRecomandari,
                    u.imagineprofil AS ImagineProfil,
                    u.id_utilizator AS user_id
                FROM profesori u
                WHERE u.id_utilizator = ?";
        // Prepare the SQL statement
        $this->db->query($sql);

        // Bind the parameters
        $this->db->bind(1, $teacherId);

        // Execute the statement and return the result
        return $this->db->single();
    }

    public function updateUserDetail($teacherId, $details)
    {
        // Check if the teacher details exist
        $checkSql = "SELECT COUNT(*) as count FROM profesori WHERE id_utilizator = ?";
        $this->db->query($checkSql);
        $this->db->bind(1, $teacherId);
        $row = $this->db->single();

        if ($row && $row['count'] > 0) {
            // If the record exists, update it
            $sql = "UPDATE profesori SET nume = ?, experienta = ?, ocupatie = ?, studii = ?, calificari = ?, materia = ?, pretsedinta = ?, numartelefon = ?, descriere = ?, locatie = ?, datainscriere = ?, numarrecenzii = ?, numarrecomandari = ?, imagineprofil = ? WHERE id_utilizator = ?";
        } else {
            // If the record does not exist, insert a new one
            $sql = "INSERT INTO profesori (nume, experienta, ocupatie, studii, calificari, materia, pretsedinta, numartelefon, descriere, locatie, datainscriere, numarrecenzii, numarrecomandari, imagineprofil, id_utilizator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        }

        $this->db->query($sql);
        $this->db->bind(1, $details['nume']);
        $this->db->bind(2, $details['experienta']);
        $this->db->bind(3, $details['ocupatie']);
        $this->db->bind(4, $details['studii']);
        $this->db->bind(5, $details['calificari']);
        $this->db->bind(6, $details['materia']);
        $this->db->bind(7, $details['pretsedinta']);
        $this->db->bind(8, $details['numartelefon']);
        $this->db->bind(9, $details['descriere']);
        $this->db->bind(10, $details['locatie']);
        $this->db->bind(11, $details['datainscriere']);
        $this->db->bind(12, $details['numarrecenzii']);
        $this->db->bind(13, $details['numarrecomandari']);
        $this->db->bind(14, $details['imagineprofil']);
        $this->db->bind(15, $teacherId);

        if ($this->db->execute()) {
            $this->component('toaster', ['message' => 'Profile updated successfully.']);
        } else {
            $this->component('toaster', ['message' => 'An error occurred. Please try again.']);
        }
    }


    public function createSession($teacherId, $studentId, $date, $link, $startTime, $endTime)
    {
        $sql = "INSERT INTO sesiuni (id_profesor, id_student, data, link, ora_de_inceput, ora_de_sfarsit) VALUES (?, ?, ?, ?, ?, ?)";
        $this->db->query($sql);
        $this->db->bind(1, $teacherId);
        $this->db->bind(2, $studentId);
        $this->db->bind(3, $date);
        $this->db->bind(4, $link);
        $this->db->bind(5, $startTime);
        $this->db->bind(6, $endTime);
        if ($this->db->execute()) {
            $this->component('toaster', ['message' => 'Session created successfully.']);
        } else {
            $this->component('toaster', ['message' => 'An error occurred. Please try again.']);
        }
    }

    public function getSessions($id, $type)
    {
        if ($type == 'student') {
            $sql = "SELECT 
                        s.id AS session_id,
                        s.data AS session_date,
                        s.link AS session_link,
                        s.ora_de_inceput AS session_start_time,
                        s.ora_de_sfarsit AS session_end_time,
                        u.id AS teacher_id,
                        u.nume AS teacher_name,
                        u.locatie AS teacher_location
                    FROM sesiuni s
                    JOIN profesori u ON s.id_profesor = u.id_utilizator
                    WHERE s.id_student = ?";
        } else if ($type == 'tutor') {
            $sql = "SELECT 
                        s.id AS session_id,
                        s.data AS session_date,
                        s.link AS session_link,
                        s.ora_de_inceput AS session_start_time,
                        s.ora_de_sfarsit AS session_end_time,
                        u.id AS teacher_id,
                        u.nume AS teacher_name,
                        u.locatie AS teacher_location
                    FROM sesiuni s
                    JOIN profesori u ON s.id_profesor = u.id_utilizator
                    WHERE s.id_profesor = ?";
        } else {
            throw new Exception('Invalid type specified');
        }

        $this->db->query($sql);
        $this->db->bind(1, $id);
        $results = $this->db->resultSet();

        return $results;
    }
    public function updateProfilePicture($userId)
    {
        if (isset($_FILES["profile_picture"])) {
            $imagePath = $_FILES["profile_picture"]["tmp_name"];
            $imageName = $_FILES["profile_picture"]["name"];
            $targetDir = "C:/xampp/htdocs/public/assets/profile-images/";
            $targetFilePath = $targetDir . $imageName;

            if (move_uploaded_file($imagePath, $targetFilePath)) {
                $sql = "UPDATE users SET profile_picture = ? WHERE id = ?";
                $this->db->query($sql);
                $this->db->bind(1, $imageName); // Only store the filename
                $this->db->bind(2, $userId);
                if ($this->db->execute()) {
                    $this->component('toaster', ['message' => 'Profile picture updated successfully.']);
                } else {
                    $this->component('toaster', ['message' => 'An error occurred. Please try again.']);
                }
            } else {
                echo "There was an error moving the uploaded file.";
            }
        } else {
            echo "No file uploaded";
        }
    }
}
