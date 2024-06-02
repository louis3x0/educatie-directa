<?php

$auth = new AuthController;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $full_name = $_POST['full_name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sex = $_POST['gender'];
    $role = $_POST['role'];
    $terms_and_conditions_accepted = isset($_POST['terms_and_conditions_accepted']) ? 1 : 0;

    // Call the create method
    $result = $auth->create($full_name, $password, $email, $phone, $sex, $role, $terms_and_conditions_accepted);
}


?>

<div class="container login-container">
    <div class="col-6 justify-content-center mx-auto">
        <div class="card mt-5 pt-5 pb-5">
            <div class="row">
                <h1 class="fs-3 text-center">Creare cont</h1>

                <div class="col-md-11 mx-auto">
                    <form action="<?php $_PHP_SELF ?>" method="post" class="needs-validation" novalidate>
                        <b>Inregistreaza-te ca:</b>
                        <div class="btn-group btn-group-toggle ms-3" data-toggle="buttons">
                            <label class="btn btn-outline-primary active">
                                <input type="radio" name="role" id="student" value="student" autocomplete="off" checked> Elev
                            </label>
                            <label class="btn btn-outline-primary">
                                <input type="radio" name="role" id="profesor" value="tutor" autocomplete="off"> Meditator
                            </label>
                        </div>


                        <div class="mb-3">
                            <label for="full_name" class="form-label">Nume și prenume <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Nume și prenume"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="required">*</span></label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Parolă <span class="required">*</span></label>
                            <input type="password" class="form-control" id="password" required name="password"
                                placeholder="Parolă">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Număr de telefon <span
                                    class="required">*</span></label>
                            <input type="tel" class="form-control" id="phone" placeholder="Număr de telefon"
                                name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Sex <span class="required">*</span></label>
                            <select class="form-select" id="gender" required name="gender">
                                <option value="" disabled selected hidden>Alege...</option>
                                <option value="male">Masculin</option>
                                <option value="female">Feminin</option>
                                <option value="other">Altul</option>
                            </select>
                        </div>
                        <div class="mb-3 form-check d-flex gap-2">
                            <input type="checkbox" class="form-check-input" id="terms_and_conditions_accepted" name="terms_and_conditions_accepted" value="1" required>
                            <label class="form-check-label" for="terms_and_conditions_accepted">Sunt de acord cu Termenii și condițiile și Politica de confidențialitate</label>
                        </div>

                        <button type="submit" name="submit" class="btn btn-secondary d-block mx-auto">Creează
                            cont</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (() => {
        'use strict'

        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>