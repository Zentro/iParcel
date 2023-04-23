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

if (empty($_GET["state"])) {
    header("Location: reports.php");
}

$state = $_GET["state"];
$sql = "SELECT t1.parcel_id, t2.name, t2.address, t2.city, t2.zip, t3.name, t3.address, t3.city, t3.zip 
        FROM parcels t1
        JOIN parcel_sender t2 ON t1.parcel_sender_id = t2.parcel_sender_id
        JOIN parcel_recipient t3 ON t1.parcel_recipient_id = t3.parcel_recipient_id
        WHERE t2.state = '$state' AND t3.state = '$state';";
$stmt = $dbConn->prepare($sql);
$stmt->execute();
if ($stmt->rowCount() > 0) {
} else {
    $found_states = "Can't find any parcels shipped within the selected state.";
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
            <?php include 'sidebar.include.php'; ?>
            <main class="col px-md-4 py-4" style="height: 100vh">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Parcel ID</th>
                            <th>Sender Name</th>
                            <th>Sender Address</th>
                            <th>Recipient Name</th>
                            <th>Recipient Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($found_states = $stmt->fetch()) : ?>
                            <tr>
                                <td><?php echo $found_states["parcel_id"]; ?></td>
                                <td><?php echo $found_states[1]; ?></td>
                                <td><?php echo $found_states[2]; ?></td>
                                <td><?php echo $found_states["name"]; ?></td>
                                <td><?php echo $found_states["address"]; ?></td>
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