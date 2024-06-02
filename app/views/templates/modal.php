<form action="<?php $_PHP_SELF ?>" method="post" novalidate class="modal-form" id="modalForm">
    <input type="hidden" name="form" value="modal">
    <input type="hidden" id="studentId" name="studentId" value="">
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><?php echo $modalData['title']; ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Închide"></button>
                </div>
                <div class="modal-body">
                    <?php if ($modalData['type']) { ?>
                        <div class="row">
                            <div class="col-12">
                                <label for="date" class="form-label">Dată</label>
                                <input type="date" class="form-control" id="date" name="date">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="startTime" class="form-label">Ora de început</label>
                                <input type="text" class="form-control timepicker" id="startTime" name="startTime">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="endTime" class="form-label">Ora de sfârșit</label>
                                <input type="text" class="form-control timepicker" id="endTime" name="endTime">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="linkApeel" class="form-label">Link Apel</label>
                                <input type="text" class="form-control" id="link" name="link">
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Închide</button>
                    <button type="submit" class="btn btn-primary w-50">Salvează modificările</button>
                </div>
            </div>
        </div>
    </div>
</form>

<link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<!-- jquery -->

<script>
    document.getElementById('exampleModal').addEventListener('shown.bs.modal', function () {
        var timepickers = document.querySelectorAll('.timepicker');
        timepickers.forEach(function (timepicker) {
            flatpickr(timepicker, {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                static: true,
                allowInput: true,  // This option allows users to enter text into the input field manually
            });
        });
    });

    document.getElementById('exampleModal').addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var studentId = button.getAttribute('data-student-id');
        console.log(studentId);
        document.getElementById('studentId').value = studentId;
    });
</script>