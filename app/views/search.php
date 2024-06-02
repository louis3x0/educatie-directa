<main>
    <!-- create a search form left and a search results right -->
    <div class="container mt-5">
        <div class="row">
            <h1>Profesori meditații pentru materia <?= $params['materie'] ?> din <?= $params['locatie'] ?></h1>

            <p>
                Alegeți materia și locația pentru a găsi profesorul potrivit pentru dumneavoastră.
            </p>

            <div class="col-md-4">
                <form id="searchForm" action="/cauta" method="post" class="card p-3">
                    <div class="mb-3">
                        <label for="materie" class="form-label">Materie</label>
                        <select class="form-select" id="materie" name="materie">
                            <?php foreach ($data['materii'] as $materie): ?>
                                <option value="<?= $materie['nume_materie'] ?>"
                                    <?= $params['materie'] == $materie['nume_materie'] ? 'selected' : '' ?>>
                                    <?= $materie['nume_materie'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="locatie" class="form-label">Locatie</label>
                        <select class="form-select" id="locatie" name="locatie">
                            <?php foreach ($data['judete'] as $judet): ?>
                                <option value="<?= $judet['nume_judet'] ?>" <?= $params['locatie'] == $judet['nume_judet'] ? 'selected' : '' ?>><?= $judet['nume_judet'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Cauta</button>
                </form>
            </div>

            <div class="col-md-8">
                <?php if(empty($data['teachers'])): ?>
                    <h2>Rezultatele cautarii</h2>

                    <p>Nu s-a gasit niciun profesor pentru materia <?= $params['materie'] ?> din <?= $params['locatie'] ?></strong>
                <?php endif; ?>

                <!-- teacher cards -->
                <div class="container">
                    <?php require_once '../app/views/templates/teacher-card.php'; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.getElementById('searchForm').addEventListener('submit', function (e) {
        e.preventDefault();
        var materie = document.getElementById('materie').value;
        var locatie = document.getElementById('locatie').value;
        window.location.href = '/cauta/' + encodeURIComponent(materie) + '/' + encodeURIComponent(locatie);
    });
</script>