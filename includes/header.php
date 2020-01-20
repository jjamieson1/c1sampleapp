<?php
session_start();
$cookieDomain = $_SERVER['SERVER_NAME'];
session_set_cookie_params(time() + 3600, "./",$cookieDomain, "0", "1");
include "config/config.php";
 header('X-Frame-Options: DENY');
 header("X-XSS-Protection: 1; mode=block");
 header("Content-Type: text/html");
 header("X-Content-Type-Options: nosniff");
setlocale(LC_MONETARY, 'en_US.UTF-8');

require_once "../classes/identity.php";
$identity = new Identity();
$identity->getIdentity();
require_once ("../includes/config/config.php");

$property = new Properties();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="c1-sample">
    <title> C1 Sample App </title>

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
      <link rel="stylesheet" href="/assets/css/main.css" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <![endif]-->

  </head>

<body>

<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">CitizenOne</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item <?php if($_SERVER['PHP_SELF'] == "/home/index.php") { echo "active"; } ?>">
                <a class="nav-link" href="../home/index.php">Home</a>
            </li>
            <li class="nav-item <?php if($_SERVER['PHP_SELF'] == "/applications/applications.php") { echo "active"; } ?>">
                <a class="nav-link" href="/applications/applications.php">Applications</a>
            </li>
            <li class="nav-item <?php if($_SERVER['PHP_SELF'] == "/home/tutorial.php") { echo "active"; } ?>">
                <a class="nav-link" href="/home/tutorial.php">Tutorial</a>
            </li>
            <li class="nav-item <?php if($_SERVER['PHP_SELF'] == "/admin/admin.php") { echo "active"; } ?>">
                <a class="nav-link" href="/admin/admin.php">Admin</a>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php if($_SERVER['PHP_SELF'] == "/user/user.php") { echo "active"; } ?>">
                <a class="nav-link" href="/user/user.php">Welcome <?php print $_SESSION['firstName'] . " " . $_SESSION['lastName']; ?></a>
            </li>
        </ul>
    </div>
</nav>
