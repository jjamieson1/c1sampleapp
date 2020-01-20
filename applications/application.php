<?php include("../includes/header.php"); ?>

<div class="container-fluid">
    <?php
    // Check to see if the user is authenticated
    require_once "../classes/identity.php";
    require_once "../classes/email.php";
    require_once "../classes/address.php";
    require_once "../classes/phone.php";

    $email = new Email();
    $emails = $email->getEmails();
    $phone = new Phone();
    $phones = $phone->getPhones();
    $address = new Address();
    $addresses = $address->getAddresses();
    $applicationId = $_GET['applicationId'];

    switch ($applicationId) {
        case 1:
            include "1.php";
            break;
        case 10:
            include "10.php";
            break;
        case 12:
            include "12.php";
            break;
        default:
            include "default.php";
    }

    ?>


<?php include("../includes/footer.php"); ?>
