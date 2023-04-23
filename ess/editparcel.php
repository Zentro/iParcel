<?php
define('APP_RUNNING', 1);
define('APP_ESS_PARCELS', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

if (empty($_GET["parcel_id"])) {
    header("Location: employees.php?success=false");
}

$parcel_id = $_GET["parcel_id"];

require_once '../globals.include.php';

// Get the user
$ssn = $_SESSION["employee"];
$stmt = $dbConn->prepare("SELECT users.*, employees.* FROM users, employees WHERE users.user_id = employees.user_id AND employees.employee_ssn = :ssn");
$stmt->bindParam(":ssn", $ssn);
$stmt->execute();
$user = $stmt->fetch();

// Get the parcel
$stmt = $dbConn->prepare("SELECT * FROM parcels WHERE parcel_id = :parcel_id");
$stmt->bindParam(":parcel_id", $parcel_id);
$stmt->execute();
$parcel = $stmt->fetch();

if (isset($_POST["save"])) {
    $new_date = $parcel["expected_delivery_at"];
    if (isset($_POST["ddate"])) {
        $dateTimeObj = DateTime::createFromFormat('Y-m-d', $_POST["ddate"]);
        if ($dateTimeObj === true) {
            $new_date = $dateTimeObj->format('Y-m-d H:i:s');
        }
    }
    $status = $parcel["status"];
    if (isset($_POST["status"])) {
        $status = (int)$_POST["status"];
    }

    $stmt = $dbConn->prepare("UPDATE parcels SET expected_delivery_at = :new_date, status = :status WHERE parcel_id = :parcel_id");
    $stmt->bindParam(":new_date", $new_date);
    $stmt->bindParam(":status", $status);
    $stmt->bindParam(":parcel_id", $parcel_id);
    $stmt->execute();
    header("Location: parcels.php?success=true");
}

if (isset($_POST["delete"])) {
    $stmt = $dbConn->prepare("DELETE FROM employees WHERE employee_ssn =:ssn");
    $stmt->bindParam(":ssn", $employee_ssn);
    $stmt->execute();
    header("Location: employees.php?success=true");
}
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
                <h4><a href="parcels.php"><i class="bi bi-arrow-left"></i> Go back</a></h4>
                <form action="editparcel.php?parcel_id=<?= $parcel_id; ?>" method="post">
                    <h4 class="mb-3">Adjust or make changes, click <strong>Go back</strong> to abort any changes</h4>
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="ddate" class="form-label">Set new delivery date</label>
                            <?php if($parcel["status"] == 3) : ?>
                            <input type="date" id="new_delivery_date" name="ddate" class="form-control" disabled>
                            <?php else: ?>
                            <input type="date" id="new_delivery_date" name="ddate" class="form-control">
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Set tracking status</label>
                            <?php if($parcel["status"] == 3) : ?>
                            <select class="form-select" id="status" name="status" disabled>
                                <option value="">Choose...</option>
                                <option value="0">Pre-shipment</option>
                                <option value="1">In Transit</option>
                                <option value="2">Out For Delivery</option>
                                <option value="3">Delivered</option>
                            </select>
                            <?php else: ?>
                                <select class="form-select" id="status" name="status">
                                <option value="">Choose...</option>
                                <option value="0">Pre-shipment</option>
                                <option value="1">In Transit</option>
                                <option value="2">Out For Delivery</option>
                                <option value="3">Delivered</option>
                            </select>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr class="my-4">
                    <button type="submit" name="save" class="mb-3 btn btn-lg btn-primary">Save changes</button>
                </form>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2023 iParcel</span>
                </footer>
            </main>
        </div>
    </div>
</body>

</html>