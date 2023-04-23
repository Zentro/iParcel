<?php
define('APP_RUNNING', 1);
define('APP_ESS_TRANSACTIONS', 1);

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

// Get employees
$stmt = $dbConn->prepare("SELECT
t.transaction_id AS tid,
t.total,
t.user_id,
t.status,
t.paid_on,
t.cc_name,
CASE WHEN t.user_id = '0' THEN 'Guest' ELSE u.name END AS name
FROM transactions AS t
LEFT JOIN users AS u ON t.user_id = u.user_id");
$stmt->execute();
$transactions = $stmt->fetchAll();
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
            <?php include 'sidebar.include.php'; ?>
            <main class="col px-md-4 py-4" style="height: 100vh">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Customer transaction history</h1>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">Status</th>
                            <th scope="col">Paid on</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Name on card</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($transactions as $transaction) : ?>
                            <tr>
                                <th scope="row"><a href="#"><?= $transaction["tid"]; ?></a></th>
                                <td><?= getPaidStatus($transaction["status"]); ?></td>
                                <td><?= $transaction["paid_on"]; ?></td>
                                <td><?= $transaction["name"]; ?></td>
                                <td><?= $transaction["cc_name"]; ?></td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 iParcel</span>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>