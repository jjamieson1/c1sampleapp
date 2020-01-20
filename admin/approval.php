<?php include("../includes/header.php"); ?>

<div class="container-fluid">
    <?php
    $approval_id = $_GET['approval_id'];
    ?>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="well well-lg">

                <?php
                // Get application status for user
                require_once("../classes/application.php");
                $application = new Application();
                $app = $application->getApprovalById($approval_id);
                ?>
                <h4><?php print $app['applicationName']; ?> Application</h4>
                <table class="table">


                    <?php
                    print "<tr><th>Name</th><th colspan='4'>Details</th></tr>";
                    print "<tr>";
                    print "<td>".$app['firstname']. " " . $app['lastname']."</td>";
                    print "<td colspan='4'>".$app['details']."</td>";
                    print "</tr>";
                    print "<tr><th>Application Name</th><th>Description</th><th>Status</th><th>Action</th><th></th></tr>";
                    print "<tr>";
                    print "<td>" . $app['applicationName']."</td>";
                    print "<td>" . $app['description'] . "</td>";
                    print "<td>".$app['status']."</td>";
                    print "<td>";
                    ?>
                    <form class="form" action="#" method="post">
                        <input type="hidden" name="approval_id" value="<?php echo $_GET['approval_id']; ?>" />
                        <input type="hidden" name="c1accountId" value="<?php echo $app['c1accountId']; ?>" />
                        <input type="hidden" name="api_key" value="<?php echo $app['api_key']; ?>" />
                        <input type="hidden" name="app_key" value="<?php echo $app['app_key']; ?>" />
                        <input type="hidden" name="type" value="status" />
                        <select class="form-control" name="status">
                            <option value="APPROVED">Approve</option>
                            <option value="PENDING">Pending</option>
                            <option value="REVIEWING">Reviewing</option>
                            <option value="REJECTED">Reject</option>
                            <option value="EXPIRED">Reject</option>
                        </select><br/>
                            <input type="submit" class="btn btn-primary" value="Change Status" />
                    </form>
                    <?php
                    if($_POST['type'] == "status"){
                        require_once ("../classes/status.php");
                        $status = new Status();
                        $r = $status->updateApproval($_POST);
                        if ($r['status'] == true) {
                            print "<br /><alert class='alert alert-success'>" .$r['message']."</alert>";
                        } else {
                            print "<br /><alert class='alert alert-danger'>" .$r['message']."</alert>";
                        }
                        print "<hr/>";
                    }
                    ?>
                </td>
                </tr>
                </table>
            </div>
            <hr/>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <h4>Send a notification to the user</h4>
<!--            <pre>--><?php //print json_encode($app); ?><!--</pre>-->
            <form class="form" action="#" method="post">
                <label>Notification</label><br/>
                <input type="hidden" name="approval_id" value="<?php echo $_GET['approval_id']; ?>" />
                <input type="hidden" name="c1accountId" value="<?php echo $app['c1accountId']; ?>" />
                <input type="hidden" name="api_key" value="<?php echo $app['api_key']; ?>" />
                <input type="hidden" name="app_key" value="<?php echo $app['app_key']; ?>" />
                <input type="hidden" name="type" value="notification" />
                <label>Subject</label><br/>
                <input type="text" class="form-control" name="subject" required/><br />
                <label>Body</label>
                <textarea class="form-control" cols="50" name="body" required></textarea><br />
                <label>Short Body</label>
                <input type="text" class="form-control" name="short-body" /><br />
                    <input type="submit" class="btn btn-primary" value="Send Notification" />
            </form>
            <?php
            if($_POST['type'] == "notification"){
                require_once ("../classes/notification.php");
                $notification = new Notification();
                $r = $notification->sendNotification($app['c1accountId'], $_POST);
                if ($r['status'] == true) {
                    print "<br /><alert class='alert alert-success'>" .$r['message']."</alert>";
                } else {
                    print "<br /><alert class='alert alert-danger'>" .$r['message']."</alert>";
                }
                print "<hr/>";
            }
             ?>
            </div>
            <div class="col-md-4">
            <h4>Send an invoice to the user</h4>
            <form class="form" action="#" method="post">
                <label>Invoice</label><br/>
                <input type="hidden" name="approval_id" value="<?php echo $_GET['approval_id']; ?>" />
                <input type="hidden" name="c1accountId" value="<?php echo $app['c1accountId']; ?>" />
                <input type="hidden" name="api_key" value="<?php echo $app['api_key']; ?>" />
                <input type="hidden" name="app_key" value="<?php echo $app['app_key']; ?>" />

                <input type="hidden" name="type" value="invoice" />
                <select class="form-control" name="invoice">
                    <option value="1">Fee for Service $100</option>
                    <option value="2">Fee for Certificate $100</option>
                    <option value="3">Fee for Permit $100</option>
                </select><br />
                <input type="submit" class="btn btn-primary" value="Send Invoice" />
            </form>
                <?php
                if($_POST['type'] == "invoice"){
                    require_once ("../classes/invoice.php");
                    $invoice = new Invoice();
                    $r = $invoice->sendInvoice($app['c1accountId'], $_POST);
                    if ($r['status'] == true) {
                        print "<br /><alert class='alert alert-success'>" .$r['message']."</alert>";
                    } else {
                        print "<br /><alert class='alert alert-danger'>" .$r['message']."</alert>";
                    }
                    print "<hr/>";
                }
                ?>
            </div>
        <div class="col-md-4">
            <h4>Send a  Document</h4>
            <form class="form" action="#" method="post">
                <label>Send Digital Document</label><br/>
                <input type="hidden" name="approval_id" value="<?php echo $_GET['approval_id']; ?>" />
                <input type="hidden" name="type" value="document" />
                <select class="form-control" name="document">
                    <option value="1">Send notice of service</option>
                    <option value="2">Send certificate example</option>
                    <option value="3">Send permit example</option>
                </select><br />
                <input type="submit" class="btn btn-primary" value="Deliver File" />
            </form>
        </div>
    </div>
</div>


<?php include("../includes/footer.php"); ?>
