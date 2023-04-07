<?php defined('IN_APP') or exit('This file cannot be accessed directly.'); ?>
<nav class="navbar navbar-expand-lg shadow">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="img/logo.svg" alt="iParcel" width="150">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-end flex-grow-1 mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="newshipping.php">Shipping</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="tracking.php">Tracking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#">Support</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle"></i> My account
                    </a>
                    <ul class="dropdown-menu">
                    <?php if (!isset($_SESSION["user"])): ?>
                        <li><a class="dropdown-item" href="login.php">Login</a></li>
                        <li><a class="dropdown-item" href="newaccount.php">Register</a></li>
                    <?php else: ?>
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="dashboard.php">Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>