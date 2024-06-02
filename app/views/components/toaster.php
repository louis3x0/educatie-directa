<?php
/**
 * Toaster Component
 *
 * Represents a toaster component that displays a message to the user.
 */
?>

<div class="toast align-items-center text-bg-success border-0 fade show position-absolute bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
        <div class="toast-body">
            <?= $message ?>
        </div>
        <button type="button" class="btn-close btn-close-white btn-sm me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
</div>