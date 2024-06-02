<?php

$profile = new ProfileController();

$userId = $_SESSION['user_id'];

$applications = $profile->getUserApplications($userId);

?>

<div class="container mt-5 mb-5">
    <div class="row gx-5">
        <div class="col-md-3">
            <div class="row background">
                <div class="col-md-12 mx-auto pb-3 pt-3">
                    <div class="row">
                        <img src="<?php echo (!empty($data['profile_picture'])) ? '/assets/profile-images/' . $data['profile_picture'] : 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg'; ?>"
                            class="img-fluid no-photo mb-5" alt="Profile Picture" id="profile_picture_preview">
                        <input type="file" name="profile_picture" id="profile_picture" style="display: none;"
                            onchange="previewImage(event)">
                    </div>
                    <div class="col-md-12">
                        <p><strong>Nume și prenume:</strong>
                            <?php echo isset($data['full_name']) ? $data['full_name'] : ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Email:</strong> <?php echo isset($data['email']) ? $data['email'] : ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Număr de telefon:</strong> <?php echo isset($data['phone']) ? $data['phone'] : ''; ?>
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Sex:</strong> <?php echo isset($data['sex']) ? $data['sex'] : ''; ?></p>
                    </div>
                    <div class="col-md-12">
                        <p><strong>Role:</strong> <?php echo isset($data['role']) ? $data['role'] : ''; ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row background">
                <div class="col-md-12 pb-3 pt-3">
                    <div class="row">
                        <h2 class="fs-4 fw-bold">Solicitări de meditație</h2>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nume Profesor</th>
                                    <th scope="col">Email Profesor</th>
                                    <th scope="col">Telefon Profesor</th>
                                    <th scope="col">Stare</th>
                                    <th scope="col">Data Aplicării</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($applications): ?>
                                    <?php foreach ($applications as $application): ?>
                                        <tr>
                                            <td><?= $application['teacher_name'] ?></td>
                                            <td><?= $application['teacher_email'] ?></td>
                                            <td><?= $application['teacher_phone'] ?></td>
                                            <td>
                                                <?php switch ($application['application_status']):
                                                    case 'pending': ?>
                                                        <i class="fas fa-hourglass-half text-secondary"></i>
                                                        <?php break;
                                                    case 'approved': ?>
                                                        <i class="fas fa-check-circle text-success"></i>
                                                        <?php break;
                                                    case 'rejected': ?>
                                                        <i class="fas fa-times-circle text-danger"></i>
                                                        <?php break;
                                                    default: ?>
                                                        <i class="fas fa-question-circle"></i>
                                                <?php endswitch; ?>
                                            </td>
                                            <td><?= $application['application_date'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan='5'>Nu există cereri de meditație</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
</script>