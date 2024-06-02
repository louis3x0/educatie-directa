<?php foreach ($data["teachers"] as $teacher): ?>
    <div class="row">
        <div class="our-teachers p-0"
            onclick="window.location.href = '/<?php echo urlencode($teacher["Ocupatie"]); ?>/mediator-<?php echo urlencode($teacher["Nume"]); ?>_<?php echo $teacher["ID_Utilizator"]; ?>'">
            <div class="card mb-3">
                <div class="row g-0 gx-3">
                    <div class="col-md-4 d-flex align-items-center justify-content-center">
                        <img src="<?php echo $teacher["ImagineProfil"]; ?>" class="img-fluid rounded-start photo" alt="...">
                    </div>
                    <div class="col-md-8 d-flex align-items-center">
                        <div class="card-body">
                            <div class="d-flex gap-3 align-items-center mb-2">
                                <span class="tag">
                                    <?php echo $teacher["Materia"]; ?>
                                </span>
                                <h2 class="card-text fs-4 fw-bold">
                                    <?php echo $teacher["Nume"]; ?> -
                                    <?php echo $teacher["Ocupatie"]; ?>
                                </h2>
                            </div>

                            <small>
                                <b>Preț:</b> <span class="text-body-emphasis">
                                    <?php echo $teacher["PretSedinta"]; ?> RON / oră
                                </span>
                            </small>

                            <div class="row mt-3">
                                <div class="col-lg-3 col">
                                    <p>
                                        <small>
                                            <b>Elevi activi:</b> <span class="text-body-emphasis">6</span>
                                        </small>
                                    </p>

                                    <p>
                                        <small>
                                            <b>Ore meditate:</b> <span class="text-body-emphasis">1</span>
                                        </small>
                                    </p>
                                </div>
                                <div class="col">
                                    <p>
                                        <small>
                                            <b>Recenzii:</b> <span class="text-body-emphasis">
                                                <?php echo $teacher["NumarRecenzii"]; ?>
                                            </span>
                                        </small>
                                    </p>

                                    <p>
                                        <small>
                                            <b>Recomandari:</b> <span class="text-body-emphasis">
                                                <?php echo $teacher["NumarRecomandari"]; ?>
                                            </span>
                                        </small>
                                    </p>
                                </div>

                                <p class="text-break text-sm">
                                    <?php echo $teacher["Descriere"]; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>