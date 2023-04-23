<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

if (empty($_GET["tracknum"])) {
    header("Location: tracking.php");
}

$tracknum = $_GET["tracknum"];

$stmt = $dbConn->prepare("SELECT * FROM parcels WHERE code = ?");
$stmt->execute([$tracknum]);
if ($stmt->rowCount() > 0) {
    $parcel = $stmt->fetch();
} else {
    $parcel = "That parcel could not be found in the system.";
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
    <div class="container py-5 h-100">
        <div class="row">
            <div class="col">
                <h2>Tracking Results</h2>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Package Status:</h5>
                        <?php $dt = new DateTime($parcel["expected_delivery_at"]); ?>
                        <p class="card-text">Your package is currently <?php echo getDeliveryStatus($parcel["status"]); ?> and scheduled for delivery on <?= $dt->format('l, F j, Y'); ?>. <?php if ($parcel["status"] == 4) : ?>
                                <span class="badge rounded-pill text-bg-danger">Late</span>
                            <?php endif; ?>
                        </p>
                        <?php if ($parcel["type"] == 1) : ?>
                            <div class="alert alert-warning" role="alert">
                                Your package is considered heavy because it is more than 10 pounds. Your billing will reflect that.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="col">
                <img src="img/shipping-stock-photo.jpg" class="rounded-3 shadow-lg">
            </div>
        </div>
    </div>

    <?php include 'footer.include.php'; ?>
</body>

</html>