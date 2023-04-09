<?php
define('IN_APP', 1);

ob_start();
session_start();

require_once 'globals.include.php';

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
}

$user_id = $_SESSION["user"];

$stmt = $dbConn->prepare("SELECT name,email FROM users WHERE user_id= :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
$user = $stmt->fetch();

$name = $user["name"];
$email = $user["email"];

$parcels = [];
$stmt = $dbConn->prepare("SELECT p.code, p.status, pr.name, pr.company, pr.city, pr.state
FROM parcels AS p
JOIN parcel_recipient AS pr ON p.parcel_recipient_id = pr.parcel_recipient_id
WHERE p.user_id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $parcels = $stmt->fetchAll();
}

$transactions = [];
$stmt = $dbConn->prepare("SELECT * FROM transactions WHERE user_id = :user_id");
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();
if ($stmt->rowCount() > 0) {
    $transactions = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>iParcel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.include.php'; ?>
    <div class="px-4 py-5 my-5">
        <div class="container">
            <?php include 'confirm-email.include.php'; ?>

            <h2 class="mb-4">Welcome <?= $name; ?> <small class="text-body-secondary">(<?= $email; ?>)</small></h2>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tracking ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Recipient name</th>
                        <th scope="col">Recipient company</th>
                        <th scope="col">Recipient city</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($parcels)) : ?>
                        <tr class="text-center">
                            <td colspan="5">
                                <h4 class="py-4 my-4"><i class="bi bi-box2-heart-fill"></i>
                                    Ready to start shipping? <a href="newshipping.php">Get started now!</a></h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($parcels as $parcel) : ?>
                        <tr>
                            <th><a href="viewtracking.php?tracknum=<?= $parcel["code"]; ?>"><?= $parcel["code"]; ?></a></th>
                            <th><?= getDeliveryStatus($parcel["status"]); ?></th>
                            <th><?= $parcel["name"]; ?></th>
                            <th><?= $parcel["company"]; ?></th>
                            <th><?= $parcel["city"]; ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>

            <h4>My transaction history</h4>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Transaction ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total</th>
                        <th scope="col">Paid on</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($transactions)) : ?>
                        <tr class="text-center">
                            <td colspan="5">
                                <h4 class="py-4 my-4">You have no transaction history with us</h4>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($transactions as $transaction) : ?>
                        <tr>
                            <th><?= $transaction["transaction_id"]; ?></th>
                            <th><span class="badge rounded-pill text-bg-success"><?= getPaidStatus($transaction["status"]); ?></span></th>
                            <th>$ <?= $transaction["total"]; ?></th>
                            <th><?= $transaction["paid_on"]; ?></th>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
            * If you have a transaction dispute, please contact us.
        </div>
    </div>
    <?php include 'footer.include.php'; ?>
</body>

</html>