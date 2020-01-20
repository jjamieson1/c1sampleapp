<?php
// Get application status for user
require_once("../classes/application.php");
$application = new Application();
$app = $application->getApplication($applicationId);
$approval = $application->getApprovalsByIdentityIdAndApplicationId($_SESSION['userId'], $applicationId);
?>
<br />
<div class="container-fluid">
<div class="well">
    <div class="row">
        <div class="col-xs-3">
            <img style="width: 300px" src="/assets/img/doctor1.jpg" />
        </div>
            <div class="col-xs-9  align-self-center mx-auto">
                <h1 class="display-4"><?php print $app['name']; ?></h1>
                <p class="lead">An example scheduling application for the  CitizenOne Ecosystem</p>
                <hr class="my-4">
                <p>A Sample application along with a tutorial to show off the features of CitizenOne.</p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="/home/tutorial.php" role="button">Learn more</a>
                </p>
            </div>
        </div>
    </div>
<hr />
<?php if ($_POST) {

    print "<div style='text-align: center'><alert class='alert alert-success'><i class='fa fa-exclamation-circle'></i> Success, your appointment has been scheduled</alert></div><br />";

    print "<div class='grey-block-container'>";

    print "<h5>Details</h5>";
    print "Your appointment is scheduled for " . $_POST['day']. " at " . $_POST['time'] . " in the office of " . $_POST['provider'];

    require_once ("../classes/notification.php");
    $notification = new Notification();
    $postBody['subject'] = "You have a scheduled appointment";
    $postBody['body'] = "Your appointment is scheduled for " . $_POST['day']. " at " . $_POST['time'] . " in the office of " . $_POST['provider'];
    $postBody['shortbody'] = "Your appointment is scheduled for " . $_POST['day']. " at " . $_POST['time'] . " in the office of " . $_POST['provider'];
    $postBody['notificationCategoryType'] = "INDIVIDUAL";
    $notification->sendNotification($app['c1accountId'], $postBody);
    print "<br />We have sent a notification as well to your CitizenOne dashboard <br />";
    print "</div>";

} else {



    ?>

<div class="row">


    <div class="col-md-4 panel">
        <div class="card grey-background">
            <div class="card-block">
                <h5 class="card-title">Your contact information</h5>
                <p class="card-text">
                    <span><?php echo $_SESSION['firstName']; ?></span>
                    <span><?php echo $_SESSION['lastName']; ?></span><br />

                        <?php echo $addresses[0]['addressLine1']; ?><br/>
                        <?php echo $addresses[0]['city']; ?><br/>
                        <?php echo $addresses[0]['provinceCode']; ?><br/>
                        <?php echo $addresses[0]['postalCode']; ?>
                    <br />
                    <br />
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-4 panel">
        <div class="card grey-background">
            <div class="card-block">
            <h5 class="card-title">Connect to your health provider</h5>
            <form action="#" class="form" method="POST">
                <label>Please select region</label>
                <select class="form-control" name="region" required>
                    <option value="Athabasca Health Authority">Athabasca Health Authority</option>
                    <option value="Cypress Health Region">Cypress Health Region</option>
                    <option value="Five Hills Health Region">Five Hills Health Region</option>
                    <option value="Heartland Health Region">Heartland Health Region</option>
                    <option value="Keewatin Yatthé Health Region">Keewatin Yatthé Health Region</option>
                    <option value="Kelsey Trail Health Region">Kelsey Trail Health Region</option>
                    <option value="Mamawetan Churchill River Health Region">Mamawetan Churchill River Health Region</option>
                    <option value="Prairie North Health Region">Prairie North Health Region</option>
                    <option value="Prince Albert Parkland Health Region">Prince Albert Parkland Health Region</option>
                    <option value="Regina Qu'Appelle Health Region">Regina Qu'Appelle Health Region</option>
                    <option value="Saskatoon Health Region">Saskatoon Health Region</option>
                    <option value="Sun Country Health Region">Sun Country Health Region</option>
                    <option value="Sunrise Health Region">Sunrise Health Region</option>
                </select>
                <label>Please select office</label>
                <select class="form-control" name="provider" required>
                    <option value="9th Avenue North Medical Clinic">9th Avenue North Medical Clinic</option>
                    <option value="Al Ritchie Health Action Centre">Al Ritchie Health Action Centre</option>
                    <option value="Autism Centre">Autism Centre</option>
                    <option value="Core Medicenter">Core Medicenter</option>
                    <option value="Dynacare Medical Laboratory - Broad Street">Dynacare Medical Laboratory - Broad Street</option>
                    <option value="Family Medicine Unit">Family Medicine Unit</option>
                    <option value="Four Directions Community Health Centre">Four Directions Community Health Centre</option>
                    <option value="Gateway Alliance Medical Clinic (South)">Gateway Alliance Medical Clinic (South)</option>
                    <option value="Harbour Landing Medical Clinic">Harbour Landing Medical Clinic</option>
                    <option value="Kidney Health Centre">Kidney Health Centre</option>
                    <option value="Meadow Primary Health Care Centre">Meadow Primary Health Care Centre</option>

                </select>
            </div>
        </div>
    </div>

    <div class="col-md-4 panel">
        <div class="card grey-background">
            <div class="card-block">
            <h5 class="card-title">Pick a day and time</h5>
                <p class="card-text">
                <label>Please select day</label>
                <select class="form-control" name="day" required>
                    <option value="Monday, April 2 ">Monday, April 2 </option>
                    <option value="Tuesday, April 3">Tuesday, April 3</option>
                    <option value="Wednesday, April 4">Wednesday, April 4</option>
                    <option value="Thursday, April 5">Thursday, April 5</option>
                    <option value="Friday, April 6">Friday, April 6</option>
                    <option value="Monday, April 9">Monday, April 9 </option>
                    <option value="Tuesday, April 10">Tuesday, April 10</option>
                    <option value="Wednesday, April 11">Wednesday, April 11</option>
                    <option value="Thursday, April 12">Thursday, April 12</option>
                    <option value="Friday, April 13">Friday, April 13</option>
                </select>
                <label>Please select time</label>
                <select class="form-control" name="time" required>
                    <option value="8:00am">8:00am</option>
                    <option value="8:30am" disabled>8:30am</option>
                    <option value="9:00am" disabled>9:00am</option>
                    <option value="9:30am">9:30am</option>
                    <option value="10:00am" disabled>10:00am</option>
                    <option value="10:30am">10:30am</option>
                    <option value="11:00am" disabled>11:00am</option>
                    <option value="11:30am" disabled>11:30am</option>
                    <option value="12:00pm" disabled>12:00pm</option>
                    <option value="12:30pm">12:30pm</option>
                    <option value="1:00pm" disabled>1:00pm</option>
                    <option value="1:30pm">1:30pm</option>
                    <option value="2:00pm">2:00pm</option>
                    <option value="2:30pm" disabled>2:30pm</option>
                    <option value="3:00pm" disabled>3:00pm</option>
                    <option value="3:30pm" disabled>3:30pm</option>
                    <option value="4:00pm" disabled>4:00pm</option>
                    <option value="4:30pm">4:30pm</option>
                </select>
                </p>
            </div>
        </div>
        </div>
    </div>

</div>
<p><br /><span class="pull-right"><input type="submit" class="btn btn-primary btn-lg form-control" name="submit" value="Schedule Appointment Now"</input></span></p>
</form>
    </div>
    <div class="bottom-padding">
        &nbsp;
    </div>
<?php } ?>