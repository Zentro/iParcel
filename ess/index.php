<?php
define('IN_APP', 1);

ob_start();
session_start();

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
    <nav class="navbar bg-body-tertiary p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="../img/logo-white.svg" alt="Logo" width="150" class="d-inline-block align-text-top">
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    John Doe
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                </svg>
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <polyline points="13 2 13 9 20 9"></polyline>
                                </svg>
                                <span class="ml-2">Employees</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                                <span class="ml-2">Transactions</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                                    <line x1="18" y1="20" x2="18" y2="10"></line>
                                    <line x1="12" y1="20" x2="12" y2="4"></line>
                                    <line x1="6" y1="20" x2="6" y2="14"></line>
                                </svg>
                                <span class="ml-2">Reports</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Admin Dashboard</h1>
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
                                <a href="#" class="btn btn-block btn-light">View all</a>
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
                    <span>Copyright © 2023 <a href="https://themesberg.com">iParcel</a></span>
                    <ul class="nav m-0">
                        <li class="nav-item">
                            <a class="nav-link text-secondary" aria-current="page" href="#">Privacy Policy</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Terms and conditions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#">Contact</a>
                        </li>
                    </ul>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
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