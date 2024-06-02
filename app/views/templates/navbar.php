<?php

require_once __DIR__ . '/../../controllers/NotificationsController.php';
use Notifications\NotificationsController;

// Set session expiration time to 1 hour (3600 seconds)
$session_expiration = 3600;
// Set session cache expire time to the same value as session expiration time
session_cache_expire($session_expiration);
session_set_cookie_params($session_expiration);

// Start session if it's not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Continue with your session handling code
// For example:
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $session_expiration)) {
    // Session expired, destroy session
    session_unset();
    session_destroy();
    header("Location: /login"); // Redirect to login page or any other desired page
    exit;
}

const notifications = new NotificationsController();

// Update last activity time
$_SESSION['last_activity'] = time();
// set login variables
$isLoggedIn = isset($_SESSION['user_id']);
$loginURL = BASEURL . '/login';
$registerURL = BASEURL . '/register';

if ($isLoggedIn) {
    $notifications = notifications->getUserNotifications($_SESSION['user_id']);
    $list = notifications->list($_SESSION['user_id']);
}

?>

<nav class="navbar bg-dark navbar-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="/assets/logo.png" alt="">
        </a>
        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <?php if ($isLoggedIn && $_SESSION['role'] !== 'admin'): ?>
                <!-- Display navigation links for logged-in users -->
                <ul class="navbar-nav ms-auto">
                    <!-- notification icon -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i> <!-- Font Awesome bell icon -->
                            <?php if (count($notifications) > 0): ?>
                                <span class="notification-count">
                                    <?php echo count($notifications); ?>
                                </span> <!-- Notification count -->
                            <?php endif; ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-left" aria-labelledby="navbarDropdown">
                            <?php
                            $unreadNotifications = 0;
                            foreach ($notifications as $notification):
                                if ($notification['read_status'] == 0):
                                    $unreadNotifications++;
                                    ?>
                                    <li><a class="dropdown-item unread" href="/profil">
                                            <i class="fas fa-exclamation-circle text-primary"></i>
                                            <?php echo $notification['message']; ?>

                                            <!-- la data de -->
                                            <span class="notification-date">
                                                <span class="timestamp-tag">
                                                    <?php echo date('d-m-Y H:i', strtotime($notification['created_at'])); ?>
                                                </span>
                                            </span>
                                        </a></li>
                                    <?php
                                endif;
                            endforeach;
                            if ($unreadNotifications == 0): ?>
                                <li><a class="dropdown-item" href="#">
                                        <i class="fas fa-info-circle text-primary"></i>
                                        Nu există notificări noi
                                    </a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profil">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sesiuni">Sesiuni</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Deconectare</a>
                    </li>
                </ul>
            <?php else:
                if (!$isLoggedIn): ?>
                    <!-- Display login and register buttons for non-logged-in users -->
                    <form class="d-flex ms-auto" role="search">
                        <button class="btn btn-light me-3" type="button"
                            onclick="window.location.href='<?php echo $loginURL; ?>'">
                            <img src="/assets/login.svg" class="img-fluid me-2" />
                            Intră în cont
                        </button>
                        <button class="btn btn-primary" type="button"
                            onclick="window.location.href='<?php echo $registerURL; ?>'">
                            + Creează cont
                        </button>
                    </form>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($isLoggedIn && isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">Deconectare</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</nav>