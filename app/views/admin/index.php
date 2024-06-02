<?php
$admin = new AdminController;

$users = $admin->getUsers();
$judete = $admin->getJudete();
$materii = $admin->getMaterii();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /');
    exit;
}

?>


<div class="container mt-5">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" id="users-tab" data-toggle="tab" href="#users">Users</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="judete-tab" data-toggle="tab" href="#judete">Judete</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="materii-tab" data-toggle="tab" href="#materii">Materii</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="users">
            <div class="container mt-5">
                <table class="table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nume</th>
                            <th>Email</th>
                            <th>Termeni si conditii</th>
                            <th>Telefon</th>
                            <th>Rol</th>
                            <th>Actiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $user['id']; ?></td>
                                <td><?php echo $user['full_name']; ?></td>
                                <td><?php echo $user['email']; ?></td>
                                <td><?php echo $user['terms_and_conditions_accepted'] ? 'Da' : 'Nu'; ?></td>
                                <td><?php echo $user['phone']; ?></td>
                                <td><?php echo $user['role']; ?></td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm delete-btn user-delete-btn"
                                        data-id="<?php echo $user['id']; ?>">
                                        <i class="fas fa-trash-alt"></i> Sterge
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="judete">
            <!-- Judete table goes here -->
            <div class="container mt-5">
                <!-- button for add new judet -->
                <a href="javascript:void(0)" class="btn btn-primary mb-3" data-toggle="modal"
                    data-target="#addJudetModal">
                    <i class="fas fa-plus"></i> Adauga Judet
                </a>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nume</th>
                            <th>Actiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($judete as $judet): ?>
                            <tr>
                                <td><?php echo $judet['id']; ?></td>
                                <td><?php echo $judet['nume_judet']; ?></td>
                                <td>
                                    <a href="javascript:void(0)" id="judete" class="btn btn-sm delete-btn judet-delete-btn"
                                        data-id="<?php echo $judet['id']; ?>">
                                        <i class="fas fa-trash-alt"></i> Sterge
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane fade" id="materii">
            <div class="container mt-5">
                <!-- button to add -->
                <a href="javascript:void(0)" class="btn btn-primary mb-3" data-toggle="modal"
                    data-target="#addMaterieModal">
                    <i class="fas fa-plus"></i> Adauga materie
                </a>
                <table class="table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nume</th>
                            <th>Categorie</th>
                            <th>Actiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($materii as $materie): ?>
                            <tr>
                                <td><?php echo $materie['id']; ?></td>
                                <td><?php echo $materie['nume_materie']; ?></td>
                                <td><?php echo $materie['categorie']; ?></td>
                                <td>
                                    <a href="javascript:void(0)" class="btn btn-sm btn delete-btn materie-delete-btn"
                                        id="materii" data-id="<?php echo $materie['id']; ?>">
                                        <i class="fas fa-trash-alt"></i> Sterge
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add judet modal -->
    <div class="modal fade" id="addJudetModal" tabindex="-1" role="dialog" aria-labelledby="addJudetModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/addJudet" method="POST" data-type="Judet">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addJudetModalLabel">Adauga judet</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body
                    ">
                        <div class="form-group
                    ">
                            <label for="nume_judet">Nume judet</label>
                            <input type="text" class="form-control" id="nume_judet" name="nume_judet">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                        <button type="submit" class="btn btn-primary">Adauga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add materie modal -->
    <div class="modal fade" id="addMaterieModal" tabindex="-1" role="dialog" aria-labelledby="addMaterieModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="/admin/addMaterie" method="POST" data-type="Materie">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMaterieModalLabel">Adauga materie</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body
                ">
                        <div class="form-group
                ">
                            <label for="nume_materie">Nume materie</label>
                            <input type="text" class="form-control" id="nume_materie" name="nume_materie">
                        </div>
                        <div class="form-group mt-3">
                            <label for="categorie">Categorie</label>
                            <input type="text" class="form-control" id="categorie" name="categorie">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Inchide</button>
                        <button type="submit" class="btn btn-primary">Adauga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        const $this = $(this);
        const id = $this.data('id');
        const url = $this.hasClass('user-delete-btn') ? '/admin/deleteUser/' + id :
            $this.hasClass('judet-delete-btn') ? '/admin/deleteJudet/' + id :
                $this.hasClass('materie-delete-btn') ? '/admin/deleteMaterie/' + id : '';

        $.ajax({
            url: url,
            type: 'DELETE',
            success: function (result) {
                // Assuming success means removal, refresh or remove the row
                $this.closest('tr').fadeOut(300, function () { $(this).remove(); });
            },
            error: function (xhr) {
                alert("Error: " + xhr.statusText);
            }
        });
    });

    $(document).on('submit', '.modal form', function (e) {
        e.preventDefault();

        var form = $(this);
        var type = form.data('type');
        var nameField = form.find('input[name="nume_' + type.toLowerCase() + '"]').val();
        var categoryField = (type === 'Materie') ? form.find('input[name="categorie"]').val() : '';

        var url = '/admin/add' + type + "/" + encodeURIComponent(nameField);
        if (type === 'Materie') {
            url += "/" + encodeURIComponent(categoryField);
        }

        $.ajax({
            url: url,
            type: 'POST',
            success: function (result) {
                var tableId = '#' + type.toLowerCase() + 's';
                if (type === 'Materie') {
                    $(tableId).append('<tr><td>' + result.id + '</td><td>' + result.name + '</td><td>' + result.category + '</td></tr>');
                } else {
                    $(tableId).append('<tr><td>' + result.id + '</td><td>' + result.name + '</td></tr>');
                }
                // close modal we don't know the id of the modal
                $('.modal').modal('hide');

                // refresh
                location.reload();
            },
            error: function (xhr, status, error) {
                console.error("Add operation failed: " + error);
                alert("Failed to add " + type.toLowerCase() + ": " + xhr.responseText);
            }
        });
    });
</script>