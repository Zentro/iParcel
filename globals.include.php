<?php

declare(strict_types=1);

// Run a version check against the required version for the app.
// Block and report to the client's browser of the version error.
$phpVersion = phpversion();
if (version_compare($phpVersion, '7.0.0', '<')) {
    die("PHP 7.0.0 or newer is required. $phpVersion does not meet this requirement.");
}

// Define the working app directory.
define("APP_DIR", __DIR__);

// Autoload the app's dependencies
require APP_DIR . '/vendor/autoload.php';

// The app should be running now, block outside acccess to this file.
defined('APP_RUNNING') or exit('This file cannot be accessed directly.');

// Load the app's environment from the environment file
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(APP_DIR . '/');
$dotenv->load();

// Create the app's config from the environment file
$config = [
    'database' => [
        'host'      => $_ENV['DB_HOST'],
        'database'  => $_ENV['DB_DATABASE'],
        'username'  => $_ENV['DB_USERNAME'],
        'password'  => $_ENV['DB_PASSWORD'],
    ],
];

$host = $config['database']['host'];
$database = $config['database']['database'];
$username = $config['database']['username'];
$password = $config['database']['password'];

// Establish a connection to the database
try {
    $dbConn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error establishing a database connection.");
}

// Cleanup unused variables
unset($host);
unset($database);
unset($username);
unset($password);

function guidv4($data = null)
{
    // Generate 16 bytes (128 bits) of random data or use the data passed into the function.
    $data = $data ?? random_bytes(16);
    assert(strlen($data) == 16);

    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // Output the 36 character UUID.
    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getDeliveryStatus($code)
{
    switch ($code) {
        case 0:
            return "Pre-shipment";
        case 1:
            return "In Transit";
        case 2:
            return "Out For Delivery";
        case 3:
            return "Delivered";
        case 4:
            return "In Transit (Late)";
    }
}

function getPaidStatus($status)
{
    switch ($status) {
        case 0:
            return "Not Paid";
        case 1:
            return "Paid";
        case 2:
            return "Pending";
        case 3:
            return "Cancelled";
    }
}

function getip()
{
    $ip = $_SERVER["REMOTE_ADDR"];
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }

    return $ip;
}

/* -----------------------------------
 * CONVERT STATE NAMES!
 * Goes both ways. e.g.
 * $name = 'Orgegon' -> returns "OR"
 * $name = 'OR' -> returns "Oregon"
 * ----------------------------------- */
function convertState($name)
{
    $states = array(
        array('name' => 'Alabama', 'abbr' => 'AL'),
        array('name' => 'Alaska', 'abbr' => 'AK'),
        array('name' => 'Arizona', 'abbr' => 'AZ'),
        array('name' => 'Arkansas', 'abbr' => 'AR'),
        array('name' => 'California', 'abbr' => 'CA'),
        array('name' => 'Colorado', 'abbr' => 'CO'),
        array('name' => 'Connecticut', 'abbr' => 'CT'),
        array('name' => 'District of Columbia', 'abbr' => 'DC'),
        array('name' => 'Delaware', 'abbr' => 'DE'),
        array('name' => 'Florida', 'abbr' => 'FL'),
        array('name' => 'Georgia', 'abbr' => 'GA'),
        array('name' => 'Hawaii', 'abbr' => 'HI'),
        array('name' => 'Idaho', 'abbr' => 'ID'),
        array('name' => 'Illinois', 'abbr' => 'IL'),
        array('name' => 'Indiana', 'abbr' => 'IN'),
        array('name' => 'Iowa', 'abbr' => 'IA'),
        array('name' => 'Kansas', 'abbr' => 'KS'),
        array('name' => 'Kentucky', 'abbr' => 'KY'),
        array('name' => 'Louisiana', 'abbr' => 'LA'),
        array('name' => 'Maine', 'abbr' => 'ME'),
        array('name' => 'Maryland', 'abbr' => 'MD'),
        array('name' => 'Massachusetts', 'abbr' => 'MA'),
        array('name' => 'Michigan', 'abbr' => 'MI'),
        array('name' => 'Minnesota', 'abbr' => 'MN'),
        array('name' => 'Mississippi', 'abbr' => 'MS'),
        array('name' => 'Missouri', 'abbr' => 'MO'),
        array('name' => 'Montana', 'abbr' => 'MT'),
        array('name' => 'Nebraska', 'abbr' => 'NE'),
        array('name' => 'Nevada', 'abbr' => 'NV'),
        array('name' => 'New Hampshire', 'abbr' => 'NH'),
        array('name' => 'New Jersey', 'abbr' => 'NJ'),
        array('name' => 'New Mexico', 'abbr' => 'NM'),
        array('name' => 'New York', 'abbr' => 'NY'),
        array('name' => 'North Carolina', 'abbr' => 'NC'),
        array('name' => 'North Dakota', 'abbr' => 'ND'),
        array('name' => 'Ohio', 'abbr' => 'OH'),
        array('name' => 'Oklahoma', 'abbr' => 'OK'),
        array('name' => 'Oregon', 'abbr' => 'OR'),
        array('name' => 'Pennsylvania', 'abbr' => 'PA'),
        array('name' => 'Rhode Island', 'abbr' => 'RI'),
        array('name' => 'South Carolina', 'abbr' => 'SC'),
        array('name' => 'South Dakota', 'abbr' => 'SD'),
        array('name' => 'Tennessee', 'abbr' => 'TN'),
        array('name' => 'Texas', 'abbr' => 'TX'),
        array('name' => 'Utah', 'abbr' => 'UT'),
        array('name' => 'Vermont', 'abbr' => 'VT'),
        array('name' => 'Virginia', 'abbr' => 'VA'),
        array('name' => 'Washington', 'abbr' => 'WA'),
        array('name' => 'West Virginia', 'abbr' => 'WV'),
        array('name' => 'Wisconsin', 'abbr' => 'WI'),
        array('name' => 'Wyoming', 'abbr' => 'WY'),
        array('name' => 'Virgin Islands', 'abbr' => 'V.I.'),
        array('name' => 'Guam', 'abbr' => 'GU'),
        array('name' => 'Puerto Rico', 'abbr' => 'PR')
    );

    $return = false;
    $strlen = strlen($name);

    foreach ($states as $state) :
        if ($strlen < 2) {
            return false;
        } else if ($strlen == 2) {
            if (strtolower($state['abbr']) == strtolower($name)) {
                $return = $state['name'];
                break;
            }
        } else {
            if (strtolower($state['name']) == strtolower($name)) {
                $return = strtoupper($state['abbr']);
                break;
            }
        }
    endforeach;

    return $return;
}

function get_user($uid)
{
    global $dbConn;
    $stmt = $dbConn->prepare("SELECT * FROM users WHERE user_id= :uid");
    $stmt->bindParam(":uid", $uid);
    $stmt->execute();
    $user = $stmt->fetch();
    return $user;
}

function generate_employee_ssn($length = 10)
{
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
