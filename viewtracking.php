<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

if(empty($_GET["tracknum"])) {
    header("Location: tracking.php");
}

$tracknum = $_GET["tracknum"];

$stmt = $dbConn->prepare("SELECT * FROM parcels WHERE code = ?");
$stmt->execute([$tracknum]);
if ($stmt->rowCount() > 0) {
    $parcel = $stmt->fetch();
    $parcel = $parcel['status'];
    $parcel = getDeliveryStatus($parcel);
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
    
    <body background="img/Houston-Road-Map.png" style="background-repeat: no-repeat; background-size: cover; background-position-y: -550px;">
    <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col">
          <div class="card card-stepper shadow" style="border-radius: 10px;">
            <div class="card-body p-4">
  
                <div class="d-flex justify-content-center align-items-center">
                    <form action="#" method="POST">
                        <label for="tracknum">Enter Tracking Number : </label>
                        <input type="text" id="tracknum" name="tracknum" required>
                        <button class="btn bg-primary text-white" type="submit">Track order details</button>
                    </form>
                </div>
              
                <hr class="my-4">
                <table>

                    <div class="d-flex flex-row justify-content-between align-items-center align-content-center" id="puttrackhere">
                    <tr>
                        <td style="padding: 10px;">Tracking Number : </td>
                        <td><?php echo $tracknum ?></td>
                    </tr>
                    <tr>

                    </tr>
                    </div>

                    <div class="d-flex flex-row justify-content-between align-items-center" id="status">
                        <tr>
                            <td style="padding: 10px;" >Status : </td>
                            <td><?php echo $parcel; ?></td>
                        </tr>
                    </div>

                </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php include 'footer.include.php'; ?>
</body>
</html>