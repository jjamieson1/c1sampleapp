<?php
class Status {

    function getStatus($identityId, $applicationId) {

        require_once ("../classes/identity.php");
        $identity = new Identity();

        $id = $identity->getIdenetityIdByC1AccountId($identityId);


        require_once ("../classes/application.php");
        $application = new Application();
        $app = $application->getApprovalsByIdentityIdAndApplicationId($id['identity_id'], $applicationId);
        $links = $application->getApplicationLinksByApplicationId($applicationId);

        $status['actions'] = Array();
        $status['labels'] = Array();
        foreach($links as $key => $link) {
            $action['label'] = $link['label'];
            $action['action'] = $link['action'];
            $action['description'] = $link['description'];
            array_push($status['actions'], $action);
        }

            if ($app['status'] == "REVIEWING") {
                $action['label'] = "Review Application";
                $action['action'] = "http://c1sampleapp.c1dev.vivvo.com/applications/application.php?applicationId=2&form=review";
                $action['description'] = "Review your application ";
                array_push($status['actions'], $action);

                $label['label'] = "Status";
                $label['value'] = $app['status'];
                array_push($status['labels'], $label);
            } else if($app['status'] == "APPROVED") {
                $action['label'] = "View Details";
                $action['action'] = "http://c1sampleapp.c1dev.vivvo.com/applications/application.php?applicationId=2&form=review";
                $action['description'] = "View your details for this service";
                array_push($status['actions'], $action);
                $action['label'] = "Download Certificate";
                $action['action'] = "http://c1sampleapp.c1dev.vivvo.com/applications/files/certificate.pdf";
                $action['description'] = "Download your certificate from this service";
                array_push($status['actions'], $action);
                $label['label'] = "Status";
                $label['value'] = $app['status'];
                array_push($status['labels'], $label);
            } else if($app['status'] == "EXPIRED") {
                $action['label'] = "Expired, Renew Now";
                $action['action'] = "http://c1sampleapp.c1dev.vivvo.com/applications/application.php?applicationId=2&form=new";
                $action['description'] = "Re-apply for service";
                array_push($status['actions'], $action);

                $label['label'] = "Status";
                $label['value'] = $app['status'];
                array_push($status['labels'], $label);
            } else if($app['status'] == "REJECTED") {
                $action['label'] = "Re-apply Now";
                $action['action'] = "http://c1sampleapp.c1dev.vivvo.com/applications/application.php?applicationId=2&form=new";
                $action['description'] = "Re-apply for service";
                array_push($status['actions'], $action);

                $label['label'] = "Status";
                $label['value'] = $app['status'];
                array_push($status['labels'], $label);
            }

        return $status;
    }
    function updateApproval($app) {
        require_once("../includes/config/database.php");
        $query = "update approvals set status = :status where approval_id = :approval_id";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("status", $app['status']);
            $stmt->bindParam("approval_id", $app['approval_id']);

            $stmt->execute();
            $result['status'] = true;
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = false;
            $result['error_message'] = "Failed to update approval: " . $e->getMessage();
            return $result;
        }
        return $result;
    }
}
?>