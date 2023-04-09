<?php
define('IN_APP', 1);

ob_start();
session_start();

if (!isset($_SESSION["employee"])) {
    header("Location: ess-login.php");
}

require_once '../globals.include.php';

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
            <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark bg-body-tertiary" style="width: 280px;">
                <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <img src="../img/logo-white.svg" alt="Logo" width="150" class="d-inline-block align-text-top">
                </a>
                <hr>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link active" aria-current="page">
                            <i class="bi bi-house"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-person-badge"></i>
                            Employees
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-currency-dollar"></i>
                            Products & Transactions
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-person-gear"></i>
                            Customers
                        </a>
                    </li>
                </ul>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <strong>John Smith</strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small">
                        <li><a class="dropdown-item" href="ess-logout.php">Logout</a></li>
                    </ul>
                </div>
            </div>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Welcome back, John Smith</h1>
                <div class="row my-4">
                    <div class="col-12 col-md-6 col-lg-3 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Customers</h5>
                            <div class="card-body">
                                <h5 class="card-title">97,893</h5>
                                <p class="card-text text-success">18.2% increase since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Revenue</h5>
                            <div class="card-body">
                                <h5 class="card-title">$2.5k</h5>
                                <p class="card-text text-success">4.6% increase since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header">Purchases</h5>
                            <div class="card-body">
                                <h5 class="card-title">43,284</h5>
                                <p class="card-text text-success">2.5% increase since last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-4 mb-lg-0 col-lg-3">
                        <div class="card">
                            <h5 class="card-header"># Of Packages</h5>
                            <div class="card-body">
                                <h5 class="card-title">20,492</h5>
                                <p class="card-text text-danger">2.6% decrease since last month</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-lg-0">
                        <div class="card">
                            <h5 class="card-header">Latest transactions</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Order</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Date</th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">17371705</th>
                                                <td>Priority</td>
                                                <td>uramamur@bcm.edu</td>
                                                <td>$25.23</td>
                                                <td>April 11 2023</td>
                                                <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>Priority</td>
                                                <td>gocoogs@uh.edu</td>
                                                <td>$80.50</td>
                                                <td>April 11 2023</td>
                                                <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17371705</th>
                                                <td>Priority</td>
                                                <td>cchao6@cougarnet.uh.edu</td>
                                                <td>$62.11</td>
                                                <td>April 10 2023</td>
                                                <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>Standard</td>
                                                <td>CougarNet@uh.edu</td>
                                                <td>$16.19</td>
                                                <td>April 10 2023</td>
                                                <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17371705</th>
                                                <td>Standard</td>
                                                <td>databasesystems@cougarnet.edu</td>
                                                <td>$18.69</td>
                                                <td>April 10 2023</td>
                                                <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                            <tr>
                                                <th scope="row">17370540</th>
                                                <td>Priority</td>
                                                <td>johndoe@gmail.com</td>
                                                <td>$26.92</td>
                                                <td>April 10 2023</td>
                                                <td><a href="#" class="btn btn-sm btn-primary">View</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <a href="#" class="btn btn-block btn-dark">View all</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="card mb-4">
                            <h5 class="card-header"># Of Packages last 6 months</h5>
                            <div class="card-body">
                                <div id="traffic-chart"></div>
                            </div>
                        </div>
                        <div class="card">
                            <h5 class="card-header">March Time Card</h5>
                            <div class="card-body">
                                <div id="traffic-chart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="pt-5 d-flex justify-content-between">
                    <span>© iParcel 2023</span>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
    <script>
        new Chartist.Line('#traffic-chart', {
            labels: ['Jan', 'Feb', 'March', 'April', 'May', 'June'],
            series: [
                [2000, 2500, 1900, 3400, 5600, 6400]
            ]
        }, {
            low: 0,
            showArea: true
        });
        new Chartist.Line('#traffic-chart2', {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 5'],
            series: [
                [20, 40, 35, 42, 29, 38]
            ]
        }, {
            low: 0,
            showArea: true
        });
    </script>
</body>

</html>