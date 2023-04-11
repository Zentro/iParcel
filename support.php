<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

?>
<!DOCTYPE html>
<html>

<head>
    <title>Contact Us</title>
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
            <div class="row justify-content-center">
                <div class="col-sm-4">
                    <div class="card shadow">
                        <div class="card-body w-100">
                            <h2 class="card-title text-center fw-bold text-primary">Contact Us</h5>
                                <form class="card-body" action="#" method="post">
                                    <div class="mb=3">
                                    </div>
                                    <label for="name">Name*</label>
                                    <input class="form-control mb-3" type="text" id="name" name="name" required>
                                    <label for="email">Email*</label>
                                    <input class="form-control mb-3" type="email" id="email" name="email" required>
                                    <label for="phone">Phone*</label>
                                    <input class="form-control mb-3" type="tel" id="phone" name="phone" required>
                                    <label for="tracking number">Tracking number (optional)</label><br>
                                    <input class="form-control  mb-3" type="tracking number" id="tracking number" name="tracking number" required>
                                    <label for="subject">Subject*</label>
                                    <input class="form-control  mb-3" type="text" id="subject" name="subject" required>
                                    <label for="message">Message*</label><br>
                                    <textarea class="form-control mb-3" id="message" name="message" required></textarea>
                                    <input class="form-control bg-primary text-white" type="submit" value="Submit">
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
  </ol>
</nav>
<h1 class="h2">Frequently Asked Questions</h1>
<div class="row my-4">
  <div class="col-12 col-md-6 col-12 mb-4 mb-lg-0">
    <div class="card">
        <h5 class="card-header">How can I file a claim for lost or damaged packages?</h5>
        <div class="card-body">
          <p class="card-text">In case of lost/damaged packages, we ask you to fill out the form at the top of this page. Briefly explain the situation so that we can find the solution that best suits you. Provide your tracking number for a faster resolution process. </p>
        </div>
      </div>
</div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-12">
        <div class="card">
            <h5 class="card-header">What is the expected delivery time for shipments?</h5>
            <div class="card-body">
              <p class="card-text">Delivery times can vary depending on the shipping method selected, distance to destination, and any potential delays in transit. You will be presented with an estimated delivery date before billing, and we will notify you in the case of a delay.</p>
            </div>
          </div>
    </div>
  </div>
  <div class="row my-4">
    <div class="col-12 col-md-6 col-12 mb-4 mb-lg-0">
      <div class="card">
          <h5 class="card-header">How are shipping rates calculated?</h5>
          <div class="card-body">
            <p class="card-text">Shipping rates depend on factors such as package weight, dimensions, destination, and shipping method. You will be presented with a rate before the billing.</p>
          </div>
        </div>
  </div>
    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-12">
        <div class="card">
            <h5 class="card-header">Are there any restrictions on shipping certain items, such as hazardous materials?</h5>
            <div class="card-body">
              <p class="card-text">Items that are either acidic, combustible, corrosive, explosive, flammable, or infectious may be shipped under specific conditions. Hazardous materials may never be shipped by air. </p>
            </div>
          </div>
    </div>
  </div>  

        <?php include 'footer.include.php'; ?>
    </body>

</html>
