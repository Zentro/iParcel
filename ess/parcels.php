<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

require_once '../globals.include.php';

// Get # of customers
$stmt = $dbConn->prepare("SELECT COUNT(*) FROM users");
$stmt->execute();
$customer_count = $stmt->fetchColumn();

// Get total of revenue
$stmt = $dbConn->prepare("SELECT SUM(total) FROM transactions");
$stmt->execute();
$revenue_sum = $stmt->fetchColumn();

// Get purchases
$stmt = $dbConn->prepare("SELECT COUNT(*) FROM transactions");
$stmt->execute();
$purchase_count = $stmt->fetchColumn();

// Get # of packages
$stmt = $dbConn->prepare("SELECT COUNT(*) FROM parcels");
$stmt->execute();
$parcel_count = $stmt->fetchColumn();

// Get the user
$ssn = $_SESSION["employee"];
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $ssn);
$stmt->execute();
$user = $stmt->fetch();

?>
<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <title>Employee Self-Service - iParcel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark bg-body-tertiary" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
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
                        <a href="transactions.php" class="nav-link text-white">
                            <i class="bi bi-currency-dollar"></i>
                            Transactions
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="parcels.php" class="nav-link active" aria-current="page">
                            <i class="bi bi-box2"></i>
                            Parcels
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
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong><?= $user["name"]; ?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small">
                        <li><a class="dropdown-item" href="ess-logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4" style="height: 100vh">

                <div class="card">
                    <h5 class="card-header">Employees</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Employee ID</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Department</th>
                                        <th scope="col"># of Hours</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">3924722</th>
                                        <td>Patel</td>
                                        <td>Ashna</td>
                                        <td>Sales</td>
                                        <td>34.3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2847233</th>
                                        <td>Galvan</td>
                                        <td>Rafael</td>
                                        <td>Support</td>
                                        <td>40.5</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">0264228</th>
                                        <td>Jahanara</td>
                                        <td>Sonny</td>
                                        <td>Sales</td>
                                        <td>32.4</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7296104</th>
                                        <td>Won</td>
                                        <td>Brandon</td>
                                        <td>Sorting</td>
                                        <td>30.6</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6452046</th>
                                        <td>Mullen</td>
                                        <td>Jason</td>
                                        <td>Sorting</td>
                                        <td>26.6</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1746395</th>
                                        <td>Gomez</td>
                                        <td>Selena</td>
                                        <td>Fullfillment</td>
                                        <td>18.5</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4629562</th>
                                        <td>McIngvale</td>
                                        <td>James</td>
                                        <td>Sales</td>
                                        <td>40.3</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8452946</th>
                                        <td>Doe</td>
                                        <td>John</td>
                                        <td>Manager</td>
                                        <td>35.7</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">1749361</th>
                                        <td>Rincon</td>
                                        <td>Carlos</td>
                                        <td>Sales</td>
                                        <td>39.4</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">9463295</th>
                                        <td>Parker</td>
                                        <td>Peter</td>
                                        <td>Fulfillment</td>
                                        <td>14.6</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3194566</th>
                                        <td>Khator</td>
                                        <td>Renu</td>
                                        <td>Sorting</td>
                                        <td>24.4</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">8452856</th>
                                        <td>Smith</td>
                                        <td>Sally</td>
                                        <td>Sorting</td>
                                        <td>29.2</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3716590</th>
                                        <td>Johnson</td>
                                        <td>John</td>
                                        <td>Fulfillment</td>
                                        <td>40.2</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4729562</th>
                                        <td>Rogers</td>
                                        <td>Chris</td>
                                        <td>Sales</td>
                                        <td>39.5</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <a href="#" class="btn btn-block btn-light">View all</a>
                    </div>
                </div>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 iParcel</span>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>