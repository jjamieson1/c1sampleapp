<br />
<div class="row">
    <div class="col-md-12">
        <div class="well well-lg">

            <?php
            // Get application status for user
            require_once("../classes/application.php");
            $application = new Application();
            $app = $application->getApplication($applicationId);
            $approval = $application->getApprovalsByIdentityIdAndApplicationId($_SESSION['userId'], $applicationId);
            ?>
            <h4><?php print $app['name']; ?> Application</h4>
            <table class="table">
                <tr><th>Name</th><th>Description</th><th>Status</th><th>Action</th></tr>

                <?php
                print "<tr><td>" . $app['name'] . "</td><td>" . $app['description'] . "</td>";
                if (isset($approval['status'])) {
                    print "<td>".$approval['status']."</td>";
                    print "<td><a href='action.php?applicationId=$applicationId&form=review' class='btn btn-primary btn-sm'>Review</a></td>";
                } else {
                    print "<td>Not Started</td>";
                    print "<td><a href='application.php?applicationId=$applicationId&form=start' class='btn btn-primary btn-sm'>Apply Now</a></td>";
                }
                print "</tr>";

                ?>
            </table>
        </div>
        <hr/>
    </div>
</div>
<?php if(isset($_GET['form'])) { ?>
    <div class="body-content row">
        <div class="col-md-6">
            <h4><?php echo $app['name']; ?> Form</h4>
            <h5>Status: New</h5>
            <hr/>
            <form class="form" action="application.php" method="post">
                <label>First Name</label>
                <input class="form-control" type="text" name="firstName" value="<?php echo $_SESSION['firstName']; ?>" required/>
                <label>Last Name</label>
                <input class="form-control" type="text" name="lastName" value="<?php echo $_SESSION['lastName']; ?>" required/>
                <label>Middle Name</label>
                <input class="form-control" type="text" name="middleName" value="<?php echo $_SESSION['middleName']; ?>" />
                <label>Address Line 1</label>
                <input class="form-control" type="text" name="addressLine1" value="<?php echo $addresses[0]['addressLine1']; ?>" required/>
                <label>Address Line 2</label>
                <input class="form-control" type="text" name="addressLine2" value="<?php echo $addresses[0]['addressLine2']; ?>"/>
                <label>City</label>
                <input class="form-control" type="text" name="city" value="<?php echo $addresses[0]['city']; ?>" required/>
                <label>Province</label>
                <input class="form-control" type="text" name="provinceCode" value="<?php echo $addresses[0]['provinceCode']; ?>" required/>
                <label>Postal Code</label>
                <input class="form-control" type="text" name="postalCode" value="<?php echo $addresses[0]['postalCode']; ?>" required/>

        </div>
        <div class="col-md-6">
            <label>Email</label>
            <input class="form-control" type="text" name="postalCode" value="<?php echo $emails[0]['emailAddress']; ?>" required/>
            <label>Phone</label>
            <input class="form-control" type="text" name="phoneNumber" value="<?php echo $phones[0]['phoneNumber']; ?>" required/>
            <label>Reason for Permit</label>
            <textarea class="form-control" name="details" rows="10" required></textarea><br />
            <input type="hidden" name="applicationId" value="<?php echo $app['applicationId']; ?>" />
            <span class="pull-right"><input class="btn btn-primary form-control" type="submit" value="Submit"/></span>
        </div>
        </form>
    </div>
<?php }

if ($_POST) {
    $result = $application->submitApplication($_POST);
    if ($result['status'] == true) {
        print "<alert class='alert alert-success'>" .$result['message']."</alert>";
    } else {
        print "<alert class='alert alert-danger'>" .$result['message']."</alert>";
    }
    print "<hr/>";
    print "<a class='btn btn-primary btn-lg' href='/applications/application.php?applicationId=".$result['applicationId']."'>Refresh</a>";
}
?>
</div>