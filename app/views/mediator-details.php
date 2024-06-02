<?php

require_once '../app/controllers/ProfileController.php';

$teacherProfile = new TeacherController();
$profileController = new ProfileController();

$params = explode('_', $_GET['url']);
$userId = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$teacherId = $params[1];

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $userId = $_SESSION['user_id']; // Get the user ID from the session

    if($userId) $result = $teacherProfile->applyForMediation($userId, $teacherId);
}


$application = $teacherProfile->checkIfUserApplied($userId, $teacherId);
$teacherDetails = $profileController->findTeacherDetails($teacherId);

if($teacherDetails === false) {
    header('Location: /');
    exit;
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card p-5 pt-4 pb-4">
                <div class="user-details d-flex align-items-center justify-content-between mb-2">
                <h5 class="mb-0"><?= $teacherDetails['nume'] . ' - ' . $teacherDetails['ocupatie'] ?></h5>                 
                    <b class="fs-5">Preț: <?= $teacherDetails['pretsedinta'] ?> lei / două ore</b>
                </div>

                <div class="location text-primary">
                    <i class="fas text-primary fa-map-marker-alt"></i> <b clas><?= $teacherDetails['locatie'] ?></b>
                </div>

                <div class="mb-1">
                    <h2>Detalii</h2>
                    <p><strong>Clasa predata:</strong> Limba Engleza</p>
                    <p><strong>Experienta:</strong> <?= $teacherDetails['experienta'] ?></p>
                    <p><strong>Studii:</strong> <?= $teacherDetails['studii'] ?></p>
                    <p><strong>Calificari:</strong> <?= $teacherDetails['calificari'] ?></p>
                    <p><strong>Descriere:</strong> <?= $teacherDetails['descriere'] ?></p>
                </div>

                <div>
                    <h2>Recenzii recente</h2>
                    <div class="card mb-1 card-review">
                        <div class="card-body">
                            <h5 class="card-title d-flex align-items-center gap-2"> Stefan Mocanu
                                <?php
                                for ($i = 0; $i < 4; $i++) {
                                    echo '<img src="/assets/filled_review.svg" class="img-fluid" alt="Review Image">';
                                }
                                echo '<img src="/assets/review.svg" class="img-fluid" alt="Review Image">';
                                ?>
                            </h5>
                            <p class="card-text">
                                <span>2023-11-14 14:25:13</span>
                            </p>
                            <p class="card-text"><b>Profesor pregătit și comunicativ</b></p>
                            <p class="card-text review">
                                Experiența a fost și este bună. Doamna profesoră este foarte serioasă și are mereu fișe
                                pentru a ma pregăti. Îmi place că vorbim mult fiindcă stăteam foarte prost la
                                comunicare.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3">
                <div class="card-body">
                    <?php
                        $imageUrl = $teacherDetails['ImagineProfil'];
                        if (!preg_match('/^https?:\/\//', $imageUrl)) {
                            // Replace 'http://yourwebsite.com' with the base URL of your website
                            $imageUrl = 'http://yourwebsite.com/' . ltrim($imageUrl, '/');
                        }
                    ?>
                    <img src="<?= $imageUrl ?>" class="img-fluid mb-3" alt="Profile Picture">
                    <button type="button" class="btn btn-secondary btn-lg w-100 d-flex justify-content-between mt-3">
                        <span class="phone-number show-number">07xx xxx xxx</span>
                        <span class="show-phone show-number">Arată telefon</span>
                    </button>

                    <p class="card-text fs-6 fw-medium mt-2">Vizualizări: 2182</p>

                    <?php
                    if (!empty($_SESSION['email']) && $_SESSION['email'] && $_SESSION['role'] !== 'tutor') {
                        if ($application) {
                    ?>
                            <div class="d-flex justify-content-between align-items-center mt-3">
                                <?php echo "Ai aplicat deja la <time>" . $application['applied_at'] . "</time>"; ?>
                            </div>
                            <button class="btn btn-primary btn-lg w-100 mt-3" disabled>Aplică pentru meditație</button>
                    <?php
                        } else {
                    ?>
                            <form action="<?php $_PHP_SELF ?>" method="post" novalidate>
                                <button type="submit" name="submit" class="btn btn-primary btn-lg w-100 mt-3">Aplică pentru meditație</button>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>