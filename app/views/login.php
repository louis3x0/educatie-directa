<?php
    // Start session if it's not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Instantiate the AuthController
    $auth = new AuthController;

    if (isset($_SESSION['user_id'])) {
        // user is logged in
        header('Location: /');
    } else {
        // user is not logged in
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $result = $auth->authenticate($email, $password);
    }
?>

<div class="container login-container">
    <div class="col-6 justify-content-center mx-auto">
        <div class="card mt-5 pt-5 pb-5">
            <div class="row">
                <h1 class="fs-3 text-center">Autentificare</h1>

                <div class="col-md-11 mx-auto">
                <form action="<?php $_PHP_SELF ?>" method="post" novalidate>
                        <div class="mb-3">
                            <label for="validationCustom01" class="form-label">Adresa de email <span
                                    class="required">*</span></label>
                            <input type="text" class="form-control"
                                name="email"
                                id="validationCustom01" placeholder="Introdu adresa de email" required>
                            <div id="emailHelp" class="form-text">Nu vom partaja adresa ta de email cu nimeni.</div>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Parola <span class="required">*</span></label>
                            <input type="password" class="form-control" id="password" required name="password"
                                placeholder="Introdu parola">
                        </div>
                        <button type="submit" name="submit"
                            class="btn btn-secondary d-block mx-auto">Autentificare</button>
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