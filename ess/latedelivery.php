<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

require_once '../globals.include.php';

// Get the user
$ssn = $_SESSION["employee"];
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $ssn);
$stmt->execute();
$user = $stmt->fetch();

if(empty($_GET["deliveries"])) {
    header("Location: reports.php");
}

$deliveries = $_GET["deliveries"];
$sql = "SELECT b1.parcel_id, b1.shipping_method, b1.status, b1.type, b1.expected_delivery_at, b2.parcel_sender_id, b3.parcel_recipient_id
        FROM parcels b1
        JOIN parcel_sender b2 ON b1.parcel_sender_id = b2.parcel_sender_id
        JOIN parcel_recipient b3 ON b1.parcel_recipient_id = b3.parcel_recipient_id
        WHERE b1.status = '$deliveries';";

$stmt = $dbConn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    
} else {
    $late_deliveries = "There are zero late deliveries.";
}
?>

<html data-bs-theme="dark">
<html>

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
            <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary col-2">
                <a href="index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-decoration-none">
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
                    <li class="nav-item">
                        <a href="reports.php" class="nav-link text-white active" aria-current="page">
                            <i class="bi bi-clipboard-data"></i>
                            Reports
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
            <main class="col px-md-4 py-4" style="height: 100vh">
                <table>
                        <thead>
                            <tr>
                                <th>Parcel ID</th>
                                <th>Shipping Method</th>
                                <th>Shipping Status</th>
                                <th>Shipping Type</th>
                                <th>Expected Delivery</th>
                                <th>Sender ID</th>
                                <th>Recipient ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($late_deliveries = $stmt->fetch()): ?>
                                <tr>
                                    <td><?php echo $late_deliveries["parcel_id"]; ?></td>
                                    <td><?php echo $late_deliveries["shipping_method"]; ?></td>
                                    <td><?php echo $late_deliveries["status"]; ?></td>
                                    <td><?php echo $late_deliveries["type"]; ?></td>
                                    <td><?php echo $late_deliveries["expected_delivery_at"]; ?></td>
                                    <td><?php echo $late_deliveries["parcel_sender_id"]; ?></td>
                                    <td><?php echo $late_deliveries["parcel_recipient_id"]; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>© iParcel 2023</span>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>