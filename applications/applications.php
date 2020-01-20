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
            <div class="well well-lg">
                <h4>Applications</h4>
                <?php
                // Get application status for user
                require_once("../classes/application.php");
                $application = new Application();
                $applications = $application->getApplications();
                $approvals = $application->getApprovalsByIdentityId($_SESSION['userId']);
                ?>
                    <table class="table">
                    <?php
                    foreach($applications as $a => $v) {
                        print "<tr><td>" . $v['applicationId'] . "</td><td>" . $v['name'] . "</td><td>" . $v['description'] . "</td><td>";
                        $status = false;
                        foreach ($approvals as $approval => $value) {
                            if ($value['applicationId'] == $v['applicationId']) {
                                print "<td><a href='application.php?applicationId=".$v['applicationId']."&form=review' class='btn btn-primary btn-sm'>".$value['status']."</a></td>";
                                $status = true;
                            }
                        }
                        if ($status == false) {
                            print "<td><a href='application.php?applicationId=".$v['applicationId']."&form=new' class='btn btn-primary btn-sm'>Apply Now</a></td>";
                        }
                        print "</tr>";
                    }
                    ?>
                    </table>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>
