<div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary col-2">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
        <img src="../img/logo-white.svg" alt="Logo" width="150" class="d-inline-block align-text-top">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="index.php" class="nav-link text-white">
                <i class="bi bi-house"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="employees.php" class="nav-link text-white">
                <i class="bi bi-person-badge"></i>
                Employees
            </a>
        </li>
        <li class="nav-item">
            <a href="transactions.php" class="nav-link text-white active" aria-current="page">
                <i class="bi bi-currency-dollar"></i>
                Transactions
            </a>
        </li>
        <li class="nav-item">
            <a href="parcels.php" class="nav-link text-white">
                <i class="bi bi-box2"></i>
                Logistics
            </a>
        </li>
        <li class="nav-item">
            <a href="customers.php" class="nav-link text-white">
                <i class="bi bi-person-gear"></i>
                Customers
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <strong><?= $user["name"]; ?></strong>
        </a>
        <ul class="dropdown-menu text-small">
            <li><a class="dropdown-item" href="ess-logout.php">Logout</a></li>
        </ul>
    </div>
</div>