<?php
define('APP_RUNNING', 1);

ob_start();
session_start();

require_once 'globals.include.php';

$stmt = $dbConn->prepare("SELECT * FROM parcel_method");
$stmt->execute();
$parcelMethods = $stmt->fetchAll();

if (isset($_POST["submit"])) {
    // Start with the sender
    $from_id = guidv4();
    $from_name = $_POST["from_name"];
    $from_email = $_POST["from_email"];
    $from_company = $_POST["from_company"];
    $from_city = $_POST["from_city"];
    $from_address = $_POST["from_address"];
    $from_country = $_POST["from_country"];
    $from_state = $_POST["from_state"];
    $from_zip = $_POST["from_zip"];

    $stmt = $dbConn->prepare("INSERT INTO parcel_sender
    (parcel_sender_id,name,address,city,state,zip,country,company)
    VALUES (:from_id,:from_name,:from_address,:from_city,:from_state,:from_zip,:from_country,:from_company)");
    $stmt->bindParam(":from_id", $from_id);
    $stmt->bindParam(":from_name", $from_name);
    $stmt->bindParam(":from_address", $from_address);
    $stmt->bindParam(":from_city", $from_city);
    $stmt->bindParam(":from_state", $from_state);
    $stmt->bindParam(":from_zip", $from_zip);
    $stmt->bindParam(":from_country", $from_country);
    $stmt->bindParam(":from_company", $from_company);
    $stmt->execute();

    // Go on to the recipient
    $to_id = guidv4();
    $to_name = $_POST["to_name"];
    $to_email = $_POST["to_email"];
    $to_company = $_POST["to_company"];
    $to_address = $_POST["to_address"];
    $to_city = $_POST["to_city"];
    $to_country = $_POST["to_country"];
    $to_state = $_POST["to_state"];
    $to_zip = $_POST["to_zip"];

    $stmt = $dbConn->prepare("INSERT INTO parcel_recipient
    (parcel_recipient_id,name,address,city,state,zip,country,company)
    VALUES (:to_id,:to_name,:to_address,:to_city,:to_state,:to_zip,:to_country,:to_company)");
    $stmt->bindParam(":to_id", $to_id);
    $stmt->bindParam(":to_name", $to_name);
    $stmt->bindParam(":to_address", $to_address);
    $stmt->bindParam(":to_city", $to_city);
    $stmt->bindParam(":to_state", $to_state);
    $stmt->bindParam(":to_zip", $to_zip);
    $stmt->bindParam(":to_country", $to_country);
    $stmt->bindParam(":to_company", $to_company);
    $stmt->execute();

    // Save the payment
    $transaction_id = guidv4();
    $total = 0;
    foreach ($parcelMethods as $parcelMethod) {
        if ($parcelMethod["parcel_method_id"] == $method) {
            $total = $parcelMethod["price"];
        }
    }
    $total = 12.0;
    $status_paid = 1; // paid
    $cc_name = $_POST["cc_name"];
    $cc_number = $_POST["cc_number"];
    $cc_exp = $_POST["cc_expiration"];
    $cc_cvv = $_POST["cc_cvv"];

    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"];
        $stmt = $dbConn->prepare("INSERT INTO transactions
            (transaction_id,total,status,cc_name,cc_number,cc_exp,cc_cvv,user_id)
            VALUES(:transaction_id,:total,:status,:cc_name,:cc_number,:cc_exp,:cc_cvv,:user_id)");
        $stmt->bindParam(":transaction_id", $transaction_id);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":status", $status_paid);
        $stmt->bindParam(":cc_name", $cc_name);
        $stmt->bindParam(":cc_number", $cc_number);
        $stmt->bindParam(":cc_exp", $cc_exp);
        $stmt->bindParam(":cc_cvv", $cc_cvv);
        $stmt->bindParam(":user_id", $user_id);
    } else {
        $stmt = $dbConn->prepare("INSERT INTO transactions
            (transaction_id,total,status,cc_name,cc_number,cc_exp,cc_cvv,user_id)
            VALUES(:transaction_id,:total,:status,:cc_name,:cc_number,:cc_exp,:cc_cvv,0)");
        $stmt->bindParam(":transaction_id", $transaction_id);
        $stmt->bindParam(":total", $total);
        $stmt->bindParam(":status", $status_paid);
        $stmt->bindParam(":cc_name", $cc_name);
        $stmt->bindParam(":cc_number", $cc_number);
        $stmt->bindParam(":cc_exp", $cc_exp);
        $stmt->bindParam(":cc_cvv", $cc_cvv);
    }
    $stmt->execute();

    // Save the parcel
    $parcel_id = guidv4();
    $weight = (float)$_POST["weight"];
    $method = (int)$_POST["method"];
    $code = generateRandomString();
    $offset_days = rand(3, 12);

    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"];
        $stmt = $dbConn->prepare("INSERT INTO parcels
        (parcel_id,status,weight,code,shipping_method,parcel_sender_id,parcel_recipient_id,user_id,expected_delivery_at,transaction_id)
        VALUES(:parcel_id,0,:weight,:code,:method,:from_id,:to_id,:user_id,DATE_ADD(CURRENT_TIMESTAMP, INTERVAL :offset_days DAY),:transaction_id)");
    } else {
        $stmt = $dbConn->prepare("INSERT INTO parcels
        (parcel_id,status,weight,code,shipping_method,parcel_sender_id,parcel_recipient_id,user_id,expected_delivery_at,transaction_id)
        VALUES(:parcel_id,0,:weight,:code,:method,:from_id,:to_id,0,DATE_ADD(CURRENT_TIMESTAMP, INTERVAL :offset_days DAY),:transaction_id)");
    }
    $stmt->bindParam(":parcel_id", $parcel_id);
    $stmt->bindParam(":weight", $weight);
    $stmt->bindParam(":code", $code);
    $stmt->bindParam(":method", $method);
    $stmt->bindParam(":from_id", $from_id);
    $stmt->bindParam(":to_id", $to_id);
    $stmt->bindParam(":offset_days", $offset_days);
    $stmt->bindParam(":transaction_id", $transaction_id);
    if (isset($_SESSION["user"])) {
        $user_id = $_SESSION["user"];
        $stmt->bindParam(":user_id", $user_id);
    }
    $stmt->execute();

    header("Location: /viewtracking.php?tracknum=" . $code);
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
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Shipping options</span>
                    </h4>
                    <?php foreach ($parcelMethods as $parcelMethod) : ?>
                        <ul class="list-group mb-3" id="cart">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0"><?= $parcelMethod["name"]; ?></h6>
                                    <small class="text-body-secondary"><?= $parcelMethod["description"]; ?></small>
                                </div>
                                <span class="text-body-secondary">$<?= $parcelMethod["price"]; ?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>$<?= $parcelMethod["price"]; ?></strong>
                            </li>
                        </ul>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <form action="newshipping.php" method="post">

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="from_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="from_name" name="from_name" placeholder="" value="" required="">
                                <div class="invalid-feedback">
                                    Valid first name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="from_email" class="form-label">Email address <span class="text-body-secondary">(Optional)</span></label>
                                <input type="email" class="form-control" id="from_email" name="from_email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="from_company" class="form-label">Company <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" name="from_company" id="from_company">
                            </div>

                            <div class="col-12">
                                <label for="from_address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="from_address" name="from_address" placeholder="1234 Main St" required="">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="from_second_address" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="from_second_address" name="from_second_address" placeholder="Apartment or suite">
                            </div>

                            <div class="col-12">
                                <label for="from_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="from_city" name="from_city" placeholder="New York">
                            </div>

                            <div class="col-md-5">
                                <label for="from_country" class="form-label">Country</label>
                                <select class="form-select" id="from_country" name="from_country" required="">
                                    <option value="">Choose...</option>
                                    <option>United States</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="from_state" class="form-label">State</label>
                                <select class="form-select" id="from_state" name="from_state" required="">
                                    <option value="">Choose...</option>
                                    <option value="Alabama">Alabama</option>
                                    <option value="Alaska">Alaska</option>
                                    <option value="Arizona">Arizona</option>
                                    <option value="Arkansas">Arkansas</option>
                                    <option value="California">California</option>
                                    <option value="Colorado">Colorado</option>
                                    <option value="Connecticut">Connecticut</option>
                                    <option value="Delaware">Delaware</option>
                                    <option value="District Of Columbia">District Of Columbia</option>
                                    <option value="Florida">Florida</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Idaho">Idaho</option>
                                    <option value="Illinois">Illinois</option>
                                    <option value="Indiana">Indiana</option>
                                    <option value="Iowa">Iowa</option>
                                    <option value="Kansas">Kansas</option>
                                    <option value="Kentucky">Kentucky</option>
                                    <option value="Louisiana">Louisiana</option>
                                    <option value="Maine">Maine</option>
                                    <option value="Maryland">Maryland</option>
                                    <option value="Massachusetts">Massachusetts</option>
                                    <option value="Michigan">Michigan</option>
                                    <option value="Minnesota">Minnesota</option>
                                    <option value="Mississippi">Mississippi</option>
                                    <option value="Missouri">Missouri</option>
                                    <option value="Montana">Montana</option>
                                    <option value="Nebraska">Nebraska</option>
                                    <option value="Nevada">Nevada</option>
                                    <option value="New Hampshire">New Hampshire</option>
                                    <option value="New Jersey">New Jersey</option>
                                    <option value="New Mexico">New Mexico</option>
                                    <option value="New York">New York</option>
                                    <option value="North Carolina">North Carolina</option>
                                    <option value="North Dakota">North Dakota</option>
                                    <option value="Ohio">Ohio</option>
                                    <option value="Oklahoma">Oklahoma</option>
                                    <option value="Oregon">Oregon</option>
                                    <option value="Pennsylvania">Pennsylvania</option>
                                    <option value="Rhode Island">Rhode Island</option>
                                    <option value="South Carolina">South Carolina</option>
                                    <option value="South Dakota">South Dakota</option>
                                    <option value="Tennessee">Tennessee</option>
                                    <option value="Texas">Texas</option>
                                    <option value="Utah">Utah</option>
                                    <option value="Vermont">Vermont</option>
                                    <option value="Virginia">Virginia</option>
                                    <option value="Washington">Washington</option>
                                    <option value="West Virginia">West Virginia</option>
                                    <option value="Wisconsin">Wisconsin</option>
                                    <option value="Wyoming">Wyoming</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="from_zip" class="form-label">ZIP</label>
                                <input type="text" class="form-control" id="from_zip" name="from_zip" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Zip code required.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Recipient address</h4>

                        <div class="row g-3">
                            <div class="col-12">
                                <label for="to_name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="to_name" name="to_name" value="" required="">
                                <div class="invalid-feedback">
                                    Valid name is required.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="to_email" class="form-label">Email address <span class="text-body-secondary">(Optional)</span></label>
                                <input type="email" class="form-control" id="to_email" name="to_email" placeholder="you@example.com">
                                <div class="invalid-feedback">
                                    Please enter a valid email address for shipping updates.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="to_company" class="form-label">Company <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="to_company" name="to_company">
                            </div>

                            <div class="col-12">
                                <label for="to_address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="to_address" name="to_address" placeholder="1234 Main St" required="">
                                <div class="invalid-feedback">
                                    Please enter your shipping address.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="to_second_address" class="form-label">Address 2 <span class="text-body-secondary">(Optional)</span></label>
                                <input type="text" class="form-control" id="to_second_address" name="to_second_address" placeholder="Apartment or suite">
                            </div>

                            <div class="col-12">
                                <label for="to_city" class="form-label">City</label>
                                <input type="text" class="form-control" id="to_city" name="to_city" placeholder="New York">
                            </div>

                            <div class="col-md-5">
                                <label for="to_country" class="form-label">Country</label>
                                <select class="form-select" id="to_country" name="to_country" required="">
                                    <option value="">Choose...</option>
                                    <option>United States</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please select a valid country.
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="to_state" class="form-label">State</label>
                                <select class="form-select" id="to_state" name="to_state" required="">
                                    <option value="">Choose...</option>
                                    <option value="Alabama">Alabama</option>
                                    <option value="Alaska">Alaska</option>
                                    <option value="Arizona">Arizona</option>
                                    <option value="Arkansas">Arkansas</option>
                                    <option value="California">California</option>
                                    <option value="Colorado">Colorado</option>
                                    <option value="Connecticut">Connecticut</option>
                                    <option value="Delaware">Delaware</option>
                                    <option value="District Of Columbia">District Of Columbia</option>
                                    <option value="Florida">Florida</option>
                                    <option value="Georgia">Georgia</option>
                                    <option value="Hawaii">Hawaii</option>
                                    <option value="Idaho">Idaho</option>
                                    <option value="Illinois">Illinois</option>
                                    <option value="Indiana">Indiana</option>
                                    <option value="Iowa">Iowa</option>
                                    <option value="Kansas">Kansas</option>
                                    <option value="Kentucky">Kentucky</option>
                                    <option value="Louisiana">Louisiana</option>
                                    <option value="Maine">Maine</option>
                                    <option value="Maryland">Maryland</option>
                                    <option value="Massachusetts">Massachusetts</option>
                                    <option value="Michigan">Michigan</option>
                                    <option value="Minnesota">Minnesota</option>
                                    <option value="Mississippi">Mississippi</option>
                                    <option value="Missouri">Missouri</option>
                                    <option value="Montana">Montana</option>
                                    <option value="Nebraska">Nebraska</option>
                                    <option value="Nevada">Nevada</option>
                                    <option value="New Hampshire">New Hampshire</option>
                                    <option value="New Jersey">New Jersey</option>
                                    <option value="New Mexico">New Mexico</option>
                                    <option value="New York">New York</option>
                                    <option value="North Carolina">North Carolina</option>
                                    <option value="North Dakota">North Dakota</option>
                                    <option value="Ohio">Ohio</option>
                                    <option value="Oklahoma">Oklahoma</option>
                                    <option value="Oregon">Oregon</option>
                                    <option value="Pennsylvania">Pennsylvania</option>
                                    <option value="Rhode Island">Rhode Island</option>
                                    <option value="South Carolina">South Carolina</option>
                                    <option value="South Dakota">South Dakota</option>
                                    <option value="Tennessee">Tennessee</option>
                                    <option value="Texas">Texas</option>
                                    <option value="Utah">Utah</option>
                                    <option value="Vermont">Vermont</option>
                                    <option value="Virginia">Virginia</option>
                                    <option value="Washington">Washington</option>
                                    <option value="West Virginia">West Virginia</option>
                                    <option value="Wisconsin">Wisconsin</option>
                                    <option value="Wyoming">Wyoming</option>
                                </select>
                                <div class="invalid-feedback">
                                    Please provide a valid state.
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="to_zip" class="form-label">ZIP</label>
                                <input type="text" class="form-control" id="to_zip" name="to_zip" placeholder="" required="">
                                <div class="invalid-feedback">
                                    ZIP code required.
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Shipment details</h4>

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="method" class="form-label">Shpping method</label>
                                <select class="form-select" id="method" name="method" aria-label="Default select example">
                                    <option selected>Choose...</option>
                                    <?php foreach ($parcelMethods as $parcelMethod) : ?>
                                        <option value="<?= $parcelMethod["parcel_method_id"]; ?>"><?= $parcelMethod["name"]; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-sm-6">
                                <label for="weight" class="form-label">Package weight</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="weight" name="weight" aria-describedby="weight">
                                    <span class="input-group-text">lb</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <h4 class="mb-3">Payment</h4>

                        <div class="my-3">
                            <div class="form-check">
                                <input id="credit" name="payment_method" type="radio" class="form-check-input" checked="" required="">
                                <label class="form-check-label" for="credit">Credit card</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="payment_method" type="radio" class="form-check-input" required="">
                                <label class="form-check-label" for="debit">Debit card</label>
                            </div>
                        </div>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cc-name" class="form-label">Name on card</label>
                                <input type="text" class="form-control" id="cc-name" name="cc_name" placeholder="" required="">
                                <small class="text-body-secondary">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="cc-number" class="form-label">Credit card number</label>
                                <input type="text" class="form-control" id="cc-number" name="cc_number" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-expiration" class="form-label">Expiration</label>
                                <input type="text" class="form-control" id="cc-expiration" name="cc_expiration" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>

                            <div class="col-md-3">
                                <label for="cc-cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cc-cvv" name="cc_cvv" placeholder="" required="">
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" name="submit" type="submit">Continue to checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.include.php'; ?>
</body>

</html>