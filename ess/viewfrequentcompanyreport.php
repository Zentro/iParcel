<?php
define('APP_RUNNING', 1);
define('APP_ESS_REPORTS', 1);

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

// Get most frequent company sender and their associated revenue
$sql = "SELECT parcel_sender.name, parcel_sender.company, COUNT(*) AS total_shipments, SUM(transactions.total) AS total_revenue
        FROM parcels
        JOIN parcel_sender ON parcels.parcel_sender_id = parcel_sender.parcel_sender_id
        JOIN transactions ON parcels.transaction_id = transactions.transaction_id
        GROUP BY parcel_sender.parcel_sender_id
        ORDER BY total_shipments DESC, total_revenue DESC
        LIMIT 1";
$stmt = $dbConn->prepare($sql);
$stmt->execute();
$frequent_sender = $stmt->fetch();
?>
<!DOCTYPE html>
<html data-bs-theme="dark">

<head>
    <!-- Your head section content -->
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
            <!-- Sidebar section -->
            <?php include 'sidebar.include.php'; ?>
            <main class="col px-md-4 py-4" style="height: 100vh">
                <h3>Most Frequent Company Sender</h3>
                <?php if ($frequent_sender) : ?>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Company</th>
                                <th scope="col">Total Shipments</th>
                                <th scope="col">Total Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $frequent_sender["name"]; ?></td>
                                <td><?= $frequent_sender["company"]; ?></td>
                                <td><?= $frequent_sender["total_shipments"]; ?></td>
                                <td><?= $frequent_sender["total_revenue"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                <?php else : ?>
                    <p>No data available.</p>
                <?php endif; ?>

                <!-- Footer section -->
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 iParcel</span>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>