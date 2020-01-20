<?php


class Document {

    function addDocumentToIdenetity($identityId, $applicationId) {
        require_once("../includes/config/database.php");
        $query = "select * from approvals where identity_id = :identityId and applicationId = :applicationId";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("identityId", $identityId);
            $stmt->bindParam("applicationId", $applicationId);
            $stmt->execute();
            $result = $stmt->fetch();
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to return approvals: " . $e->getMessage();
            return $result;
        }
        return $result;
    }

    function getApprovalsByIdentityId($identityId) {
        require_once("../includes/config/database.php");
        $query = "select * from approvals where identity_id = :identityId";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("identityId", $identityId);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to return approvals: " . $e->getMessage();
            return $result;
        }
        return $result;
    }

    function getAllApprovals() {
        require_once("../includes/config/database.php");
        $query = "select approvals.*,
                  identity.firstname,
                  identity.lastname,
                  application.name as applicationName
                from approvals
                   join application on approvals.applicationId = application.applicationId
                   join identity on approvals.identity_id = identity.identity_id";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to return approvals: " . $e->getMessage();
            return $result;
        }
        return $result;
    }


    function getApplications() {
        require_once("../includes/config/database.php");
        $query = "select * from application";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to get applications: " . $e->getMessage();
            return $result;
        }
        return $result;
    }
    function createApplication($app) {
        require_once("../includes/config/database.php");
        $query = "insert into application(name, description, form) values (:appname, :description, :form)";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("appname", $app['name']);
            $stmt->bindParam("description", $app['description']);
            $stmt->bindParam("form", $app['form']);
            $stmt->execute();
            error_log($stmt->queryString);
            $result['status'] = true;
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = false;
            $result['error_message'] = "Failed to create application: " . $e->getMessage();
            return $result;
        }
        return $result;
    }
    function getApplication($applicationId) {
        require_once("../includes/config/database.php");
        $query = "select * from application where applicationId = :applicationId";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("applicationId", $applicationId);
            $stmt->execute();
            $result = $stmt->fetch();
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to get applications: " . $e->getMessage();
            return $result;
        }
        return $result;
    }
    function submitApplication($form) {
        require_once("../includes/config/database.php");
        $query = "insert into approvals (identity_id, status, applicationId, details, submitted_date) values (:identityId, 'Submitted', :applicationId, :details, now())";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("applicationId", $form['applicationId']);
            $stmt->bindParam("identityId", $_SESSION['userId']);
            $stmt->bindParam("details", $form['details']);
            $stmt->execute();
            $result['status'] = true;
            $result['message'] = "Application submitted sucessfully";
            $result['applicationId'] = $form['applicationId'];
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = false;
            $result['message'] = "Failed to get applications: " . $e->getMessage();
            return $result;
        }
        return $result;
    }
    function getApprovalById($approval_id) {
        require_once("../includes/config/database.php");
        $query = "select approvals.*,
                  identity.firstname,
                  identity.lastname,
                  identity.c1accountId,
                  application.name as applicationName,
                  application.description
                from approvals
                   join application on approvals.applicationId = application.applicationId
                   join identity on approvals.identity_id = identity.identity_id
                   where approval_id = :approvalId";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("approvalId", $approval_id);
            $stmt->execute();
            $result = $stmt->fetch();
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to return approvals: " . $e->getMessage();
            return $result;
        }
        return $result;
    }
}

?>