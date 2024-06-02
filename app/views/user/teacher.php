<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$profile = new ProfileController();

$userId = $_SESSION['user_id'] ?? null;
$isNewUser = false;
$errors = [];

if ($userId) {
    $applications = $profile->getTeacherApplications($userId);
    $teacherDetails = $profile->findTeacherDetails($userId);

    if (empty($teacherDetails)) {
        // New user, no details found
        $isNewUser = true;
        $teacherDetails = [
            'nume' => '',
            'experienta' => '',
            'ocupatie' => '',
            'studii' => '',
            'calificari' => '',
            'materia' => '',
            'pretsedinta' => '',
            'numartelefon' => '',
            'locatie' => '',
            'descriere' => '',
            'DataInscrie' => '',
        ];
    }

    $teacherId = $userId;
}

$modalData = [
    'type' => 'calendar',
    'title' => 'Calendar',
    'footer' => 'This is the calendar footer'
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['form'])) {
    switch ($_POST['form']) {
        case 'form1':
            $applicationId = $_POST['application_id'] ?? null;
            $status = isset($_POST['approve']) ? 'approved' : 'rejected';
            if ($applicationId) {
                $profile->updateApplicantStatus($applicationId, $teacherId, $status);
            }
            break;
        case 'form2':
            // Validate input fields
            $nume = $_POST['nume'] ?? '';
            $experienta = $_POST['experienta'] ?? '';
            $ocupatie = $_POST['ocupatie'] ?? '';
            $studii = $_POST['studii'] ?? '';
            $calificari = $_POST['calificari'] ?? '';
            $materia = $_POST['materia'] ?? '';
            $pretsedinta = $_POST['pretsedinta'] ?? '';
            $numartelefon = $_POST['numartelefon'] ?? '';
            $locatie = $_POST['locatie'] ?? '';
            $descriere = $_POST['descriere'] ?? '';

            if (empty($nume)) {
                $errors[] = 'Nume is required.';
            }
            if (empty($experienta)) {
                $errors[] = 'Experienta is required.';
            }
            if (empty($ocupatie)) {
                $errors[] = 'Ocupatie is required.';
            }
            if (empty($studii)) {
                $errors[] = 'Studii is required.';
            }
            if (empty($calificari)) {
                $errors[] = 'Calificari is required.';
            }
            if (empty($materia)) {
                $errors[] = 'Materia is required.';
            }
            if (empty($pretsedinta) || !is_numeric($pretsedinta) || $pretsedinta < 0) {
                $errors[] = 'Pretsedinta is required and must be a non-negative number.';
            }
            if (empty($numartelefon) || !preg_match('/^\d+$/', $numartelefon)) {
                $errors[] = 'Numartelefon is required and must contain only digits.';
            }
            if (empty($locatie)) {
                $errors[] = 'Locatie is required.';
            }
            if (empty($descriere)) {
                $errors[] = 'Descriere is required.';
            }

            if (empty($errors)) {
                $details = [
                    'nume' => $nume,
                    'experienta' => $experienta,
                    'ocupatie' => $ocupatie,
                    'studii' => $studii,
                    'calificari' => $calificari,
                    'materia' => $materia,
                    'pretsedinta' => $pretsedinta,
                    'numartelefon' => $numartelefon,
                    'locatie' => $locatie,
                    'descriere' => $descriere,
                    'datainscriere' => date('Y-m-d H:i:s'),
                    'imagineprofil' => $_POST['imagineprofil'] ?? 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg',
                    'user_id' => $teacherId,
                    'numarrecenzii' => '0',
                    'numarrecomandari' => '0',
                    'id_utilizator' => '1'
                ];
                $profile->updateUserDetail($userId, $details);
            }
            break;
        case 'modal':
            $date = $_POST['date'] ?? null;
            $startTime = $_POST['startTime'] ?? null;
            $endTime = $_POST['endTime'] ?? null;
            $link = $_POST['link'] ?? null;
            $studentId = $_POST['studentId'] ?? null;

            $profile->createSession($teacherId, $studentId, $date, $link, $startTime, $endTime);
            break;
    }
}
?>

<div class="container mt-5 mb-5">
    <div class="row gx-5">
        <div class="col-md-4">
            <div class="row background">
                <div class="col-md-12 mx-auto pb-3 pt-3">
                    <div class="row">
                        <img src="<?= !empty($data['profile_picture']) ? '/assets/profile-images/' . $data['profile_picture'] : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg'; ?>"
                            class="img-fluid no-photo mb-5" alt="Profile Picture" id="profile_picture_preview">
                        <input type="file" name="profile_picture" id="profile_picture" style="display: none;"
                            onchange="previewImage(event)">
                    </div>
                    <div class="col-md-12">
                        <p><strong>Nume și prenume:</strong> <?= $data['full_name'] ?? ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Email:</strong> <?= $data['email'] ?? ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Număr de telefon:</strong> <?= $data['phone'] ?? ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Sex:</strong> <?= $data['sex'] ?? ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Rol:</strong> <?= $data['role'] ?? ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Recenzii:</strong> <?= $teacherDetails['NumarRecenzii'] ?? ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Recomandari:</strong> <?= $teacherDetails['NumarRecomandari'] ?? ''; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row background">
                <div class="col-md-12 pb-3 pt-3">
                    <div class="row">
                        <h2 class="fs-4 fw-bold">Solicitări de meditație</h2>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nume Elev</th>
                                    <th scope="col">Email Elev</th>
                                    <th scope="col">Telefon Elev</th>
                                    <th scope="col">Stare</th>
                                    <th scope="col">Data Aplicării</th>
                                    <th scope="col">Actiune</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($applications)): ?>
                                    <?php foreach ($applications as $application): ?>
                                        <tr>
                                            <td><?= $application['teacher_name'] ?></td>
                                            <td><?= $application['teacher_email'] ?></td>
                                            <td><?= $application['teacher_phone'] ?></td>
                                            <td>
                                                <?php
                                                switch ($application['application_status']):
                                                    case 'pending':
                                                        echo '<i class="fas fa-hourglass-half text-secondary"></i>';
                                                        break;
                                                    case 'approved':
                                                        echo '<i class="fas fa-check-circle text-success"></i>';
                                                        break;
                                                    case 'rejected':
                                                        echo '<i class="fas fa-times-circle text-danger"></i>';
                                                        break;
                                                    default:
                                                        echo '<i class="fas fa-question-circle"></i>';
                                                endswitch;
                                                ?>
                                            </td>
                                            <td><?= $application['application_date'] ?></td>
                                            <td>
                                                <form action="<?php $_PHP_SELF ?>" method="post" style="display: flex;">
                                                    <input type="hidden" name="form" value="form1">
                                                    <input type="hidden" name="application_id"
                                                        value="<?= $application['user_id'] ?>">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle btn-sm" type="button"
                                                            id="dropdownMenuButton" data-bs-toggle="dropdown"
                                                            aria-expanded="false">
                                                            Actiuni
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"
                                                            style="max-width: 200px;">
                                                            <button type="submit" name="approve" class="dropdown-item">
                                                                <i class="fas fa-check"></i> Aprobă
                                                            </button>
                                                            <button type="submit" name="reject" class="dropdown-item">
                                                                <i class="fas fa-times"></i> Respinge
                                                            </button>
                                                            <button type="button" name="session" class="dropdown-item"
                                                                data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                                data-student-id="<?= $application['user_id'] ?>">
                                                                <i class="fas fa-calendar-alt"></i> Creeaza sesiune
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan='6'>Nu există cereri de meditație</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <div class="row background">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error): ?>
                                    <li><?= $error ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="<?php $_PHP_SELF ?>" method="post" class="form-horizontal" id="teacher-details-form">
                        <input type="hidden" name="form" value="form2">
                        <input type="hidden" name="teacher_id" value="<?= $teacherDetails['teacher_id'] ?? ''; ?>">

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="nume" class="control-label">Nume:</label>
                                <input type="text" id="nume" name="nume" class="form-control"
                                    value="<?= $teacherDetails['nume'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="experienta" class="control-label">Experienta:</label>
                                <input type="text" id="experienta" name="experienta" class="form-control"
                                    value="<?= $teacherDetails['experienta'] ?>" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="ocupatie" class="control-label">Ocupatie:</label>
                                <input type="text" id="ocupatie" name="ocupatie" class="form-control"
                                    value="<?= $teacherDetails['ocupatie'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="studii" class="control-label">Studii:</label>
                                <input type="text" id="studii" name="studii" class="form-control"
                                    value="<?= $teacherDetails['studii'] ?>" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="calificari" class="control-label">Calificari:</label>
                                <input type="text" id="calificari" name="calificari" class="form-control"
                                    value="<?= $teacherDetails['calificari'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="materia" class="control-label">Materia:</label>
                                <input type="text" id="materia" name="materia" class="form-control"
                                    value="<?= $teacherDetails['materia'] ?>" required>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="pretsedinta" class="control-label">Pret per sedinta:</label>
                                <input type="number" id="pretsedinta" name="pretsedinta" class="form-control"
                                    value="<?= $teacherDetails['pretsedinta'] ?>" required>
                                <div id="price_slider" style="margin-top: 10px;"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="numartelefon" class="control-label">Numar de telefon:</label>
                                <input type="text" id="numartelefon" name="numartelefon" class="form-control"
                                    value="<?= $teacherDetails['numartelefon'] ?>" required pattern="\d+">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-6">
                                <label for="locatie" class="control-label">Locatie:</label>
                                <input type="text" id="locatie" name="locatie" class="form-control"
                                    value="<?= $teacherDetails['locatie'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label for="DataInscrie" class="control-label">Data Inscriere:</label>
                                <input type="date" disabled id="DataInscrie" name="DataInscrie" class="form-control"
                                    value="<?= $teacherDetails['DataInscrie'] ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <label for="descriere" class="control-label">Descriere:</label>
                                <textarea id="descriere" name="descriere" style="height: 250px" class="form-control"
                                    required><?= $teacherDetails['descriere'] ?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Salveaza</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/templates/modal.php'; ?>

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Load jQuery UI -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

<script>
    // Animate the profile picture
    anime({
        targets: '#profile_picture_preview',
        translateY: [-100, 0],
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutExpo'
    });

    // Animate the form
    anime({
        targets: '#teacher-details-form',
        translateY: [100, 0],
        opacity: [0, 1],
        duration: 1000,
        easing: 'easeOutExpo',
        delay: 500
    });

    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('profile_picture_preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('profile_picture_preview').addEventListener('click', function () {
        document.getElementById('profile_picture').click();

        document.getElementById('profile_picture').addEventListener('change', function () {
            var file = this.files[0];
            var formData = new FormData();
            formData.append('profile_picture', file);

            $.ajax({
                url: '/updateProfilePicture/<?= $data['id'] ?>',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    console.log(response);
                }
            });
        });
    });

    $(document).ready(function () {
        $("#price_slider").slider({
            range: "min",
            value: <?= $teacherDetails['pretsedinta'] ?? 50 ?>,
            min: 0,
            max: 200,
            slide: function (event, ui) {
                $("#pretsedinta").val(ui.value);
                $("#price_slider .ui-slider-handle").attr("data-value", ui.value);
            },
            create: function (event, ui) {
                var value = $(this).slider("value");
                $(this).find(".ui-slider-handle").attr("data-value", value);
            }
        });

        $("#pretsedinta").on("input", function () {
            var value = $(this).val();
            if ($.isNumeric(value) && value >= 0 && value <= 200) {
                $("#price_slider").slider("value", value);
                $("#price_slider .ui-slider-handle").attr("data-value", value);
            }
        });

        $("#pretsedinta").val($("#price_slider").slider("value"));
    });

    // Real-time form validation
    $('#teacher-details-form').on('submit', function (event) {
        var isValid = true;
        var requiredFields = ['nume', 'experienta', 'ocupatie', 'studii', 'calificari', 'materia', 'pretsedinta', 'numartelefon', 'locatie', 'descriere'];

        requiredFields.forEach(function (field) {
            var fieldElement = $('#' + field);
            if (fieldElement.val().trim() === '') {
                fieldElement.addClass('is-invalid');
                isValid = false;
            } else {
                fieldElement.removeClass('is-invalid');
            }
        });

        if (!isValid) {
            event.preventDefault();
        }
    });

    // Remove is-invalid class on input
    $('#teacher-details-form input, #teacher-details-form textarea').on('input', function () {
        $(this).removeClass('is-invalid');
    });
</script>

<style>
    .ui-slider-handle::after {
        content: attr(data-value);
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        background: #007bff;
        color: white;
        padding: 3px 5px;
        border-radius: 3px;
        white-space: nowrap;
    }

    .is-invalid {
        border-color: #dc3545;
    }

    .is-invalid+.invalid-feedback {
        display: block;
    }
</style>