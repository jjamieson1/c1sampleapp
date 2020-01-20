<?php include("../includes/header.php"); ?>

<div class="container-fluid">
    <?php
    // Check to see if the user is authenticated
    require_once "../classes/identity.php";
    require_once "../classes/email.php";
    require_once "../classes/address.php";

    $identity = new Identity();
    $user = $identity->getIdentity();
    $email = new Email();
    $emails = $email->getEmails();
    $address = new Address();
    $addresses = $address->getAddresses();

    ?>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="well">
                <h4>Identity Details</h4>
                <hr />
                Name: <?php echo $_SESSION['firstName']. " " . $_SESSION['lastName']; ?><br />
                User Name: <?php echo $_SESSION['userName']; ?><br />
                IdentityId: <?php echo $_SESSION['userId']; ?>
            </div>
            <br />
            <div class="well">
                <h4>Emails: </h4>
                <hr /><?php
                foreach($emails as $e => $v) {
                    print $v['emailAddress'] .  "<br />";
                }
                ?>
            </div>
            <br />
            <div class="well">
                <h4>Addresses</h4>
                <table class="table">
                    <tr><th>Address Type</th><th>Address Line 1</th><th>Address Line 2</th><th>City</th><th>Province</th><th>Postal Code</th><th>Country</th><th>Primary</th></tr>
                    <?php
                    foreach($addresses as $a => $v) {
                        print "<tr><td>".$v['addressType']."</td><td>".$v['addressLine1']."</td><td>".$v['addressLine1']."</td><td>".$v['city']."</td><td>".$v['provinceCode']."</td><td>".$v['postalCode']."</td><td>".$v['countryCode']."</td><td>".$v['isPrimary']."</td></tr>";
                    }

                    ?>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
