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
    $property = new Properties();

    ?>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="well well-lg">
                <h3>Local Applications</h3>
                <?php
                // Get application status for user
                require_once("../classes/application.php");
                $application = new Application();
                $applications = $application->getApplications();
                $approvals = $application->getApprovalsByIdentityId($_SESSION['userId']);
                ?>
                <table class="table table-striped">
                    <tr><th>Application Id</th><th>Application Name</th><th>Description</th><th>Get Status URL</th></tr>
                    <?php
                    foreach($applications as $a => $v) {
                        print "<tr><td>" . $v['applicationId'] . "</td><td>" . $v['name'] . "</td><td>" . $v['description'] . "</td>";
                        print "<td>" . $property::SITE. "/api/getstatus/". $v['applicationId']."</td>";
                        print "</tr>";
                    }
                    ?>
                </table>
                <h3>Submitted Applications</h3>
                <?php
                // Get application status for user
                require_once("../classes/application.php");
                $application = new Application();
                $approvals = $application->getAllApprovals();
                ?>
                <table class="table">
                    <tr><th>First Name</th><th>Last Name</th><th>IdentityId</th><th>Details</th><th>Application Name</th><th>Status</th></tr>
                    <?php
                    foreach($approvals as $a => $v) {
                        print "<tr><td><a class='btn btn-primary btn-sm' href='approval.php?approval_id=".$v['approval_id']."'>Edit Application ".$v['approval_id']."</a></td><td>" . $v['firstname'] . "</td><td>" . $v['lastname'] . "</td><td>" . $v['identity_id'] . "</td><td>" . $v['details'] . "</td><td>".$v['applicationName']."</td><td>" . $v['status'] . "</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
    <hr/>
    <h3>Local Identities</h3>
    <table class="table table-hover table-stripped">
        <tr><th>First Name</th><th>Last Name</th><th>Phone</th><th>Address Line1</th><th>Address Line2</th><th>City</th><th>Province</th><th>Postalcode</th><th>Email</th><th>Account Number</th><th>PIN</th></tr>
    <?php
    $i = $identity->getLocalIdentities();
    foreach($i as $a => $v) {
    print "<tr>";
    print "<td><a class='btn btn-primary btn-sm' href='history.php?identity_id=".$v['identity_id']."'>View History</a></td><td>" . $v['firstname'] . "</td><td>" . $v['lastname'] . "</td><td>" . $v['phone'] . "</td>";
    print "<td>" .$v['addressLine1']."</td>";
    print "<td>" .$v['addressLine2']."</td>";
    print "<td>" .$v['city']."</td>";
    print "<td>" .$v['province']."</td>";
    print "<td>" .$v['postalcode']."</td>";
    print "<td>" .$v['email']."</td>";
    print "<td>" .$v['accountNumber']."</td>";
    print "<td>" .$v['pin']."</td></tr>";
    }
    ?>
    </table>

    <hr/>
    <h3>Create Local Data</h3>
    <hr />
    <?php
    if($_POST) {

        if($_POST['type'] == "application") {

           $r =  $application->createApplication($_POST);

        } else if ($_POST['type'] == "account") {

            $r =  $identity->createLocalIdentity($_POST);
        }

        if ($r['status'] == true) {
            print "<p><alert class='alert alert-success'>Created Successfully</alert></p>";
            print "<a href='admin.php'>[ Back ]</a>";
        } else {
            print "<p><alert class='alert alert-danger'>Unsuccessful : ".$r['messsage']."</alert></p>";
            print "<a href='admin.php'>[ Back ]</a>";
        }

    } else {

    ?>
    <div class="row">
        <div class="col-md-6">
            <div class="well well-lg">
                <h4>Create a new application</h4>
                <form class=form" method="post" name="application" action="#">
                    <input type="hidden" name="type" value="application"/>
                    <label for="name">Application Name</label>
                    <input name="name" class="form-control" type="text" required /><br />
                    <label for="description">Description</label>
                    <input name="description" class="form-control" type="text" required /><br />
                    <label for="form">Form Identifier</label>
                    <input name="form" class="form-control" type="text" required/><br />
                    <label for="api-key">API-Key</label>
                    <input name="api-key" class="form-control" type="text" required/><br />
                    <label for="app-key">APP-Key</label>
                    <input name="app-key" class="form-control" type="text" required/><br />
                    <input type="submit" class="btn btn-primary" name="submit" value="Create" />
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div class="well well-lg">
                <h4>Create a new local user</h4>
                <form class="form" method="post" name="account" action="#">
                    <input type="hidden" name="type" value="account"/>
                    <label for="firstName">First Name</label>
                    <input name="firstName" class="form-control" type="text" required/>
                    <label for="lastName">Last Name</label>
                    <input name="lastName" class="form-control" type="text" required/>
                    <label for="addressLine1">Address Line 1</label>
                    <input name="addressLine1" class="form-control" type="text">
                    <label for="addressLine2">Address Line 1</label>
                    <input name="addressLine2" class="form-control" type="text">
                    <label for="city">City</label>
                    <input name="city" class="form-control" type="text">
                    <label for="province">Province</label>
                    <input name="province" class="form-control" type="text">
                    <label for="postalCode">Postal Code</label>
                    <input name="postalCode" class="form-control" type="text">
                    <label for="phone">Phone Number</label>
                    <input name="phone" class="form-control" type="text">
                    <label for="email">Email</label>
                    <input name="email" class="form-control" type="text">
                    <label for="accountNumber">Account Number</label>
                    <input name="accountNumber" class="form-control" type="text">
                    <label for="secretPin">Secret PIN</label>
                    <input name="pin" class="form-control" type="text"><br />
                    <input type="submit" class="btn btn-primary" name="submit" value="Create" />
                </form
            </div>
        </div>
    </div>
    <?php } ?>
</div>

<?php include("../includes/footer.php"); ?>
