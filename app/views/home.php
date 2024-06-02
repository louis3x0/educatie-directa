<main>
    <div class="filter">
        <div class="container">
            <div class="col-12">
                <h1 class="text-center fs-4 text-white mb-4">
                    Caută tutore pentru a putea învăța mai bine!
                </h1>

                <div class="row">
                    <div class="col-12 col-md-5 mb-4">
                        <select class="form-select form-select-lg w-100" id="materie">
                            <option disabled>Selectează materia</option>

                            <option value="toate">Toate materiile</option>

                            <?php
                            $groupedSubjects = [];
                            foreach ($data["subjects"] as $subject) {
                                $groupedSubjects[$subject["categorie"]][] = $subject;
                            }

                            foreach ($groupedSubjects as $key => $values): ?>
                                <optgroup label="<?php echo $key; ?>">
                                    <?php foreach ($values as $value): ?>
                                        <option value="<?php echo $value['nume_materie']; ?>">
                                            <?php echo $value['nume_materie']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-12 col-md-5 mb-4">
                        <select class="form-select form-select-lg w-100" id="locatie">
                            <option value="toate">Toate locațiile</option>
                            <optgroup label="Online">
                                <option value="online">Online</option>
                            </optgroup>
                            <optgroup label="Locații">
                                <?php foreach ($data["locations"] as $location): ?>
                                    <option value="<?= $location['nume_judet'] ?>">
                                        <?= $location['nume_judet'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </optgroup>
                        </select>
                    </div>

                    <div class="col-12 col-md-2 mb-4">
                        <button id="cautaProfesor" class="btn h-100 btn-secondary w-100">Caută profesor</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <?php require_once '../app/views/templates/teacher-card.php'; ?>
    </div>
</main>

<script src="<?= BASEURL ?>/public/js/script.js"></script>

<script>
    document.getElementById('cautaProfesor').addEventListener('click', function(e) {
        e.preventDefault();
        var materie = document.getElementById('materie').value;
        var locatie = document.getElementById('locatie').value;
        window.location.href = 'http://localhost/cauta/' + encodeURIComponent(materie) + '/' + encodeURIComponent(locatie);
    });
</script>