<?php

class Identity {

    function getIdentity() {

        require_once ("../includes/config/config.php");
        $property = new Properties();

        if(!isset($_SESSION['userId']) || empty($_SESSION['userId'])) {
            $cookie = $_COOKIE[$property::COOKIE];

            if(is_null($cookie)  || empty($_SESSION['userId'])) {
                error_log("Cookie is null");
                error_log("Cookie = " . $_COOKIE[$property::COOKIE]);
               // header('Location: '.$property::C1_LOGIN_URL.'/goto=' . urlencode($property::SITE) .'/#/login');
                exit();
            }

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_PORT => $property::C1_PORT,
                CURLOPT_URL => $property::C1_BASEURL."/id1/api/v1/authenticate?type=token",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{\n  \"token\" : \"" . $cookie . "\"\n}",
                CURLOPT_HTTPHEADER => array(
                    "api-key: " . $property::C1_API_KEY,
                    "app-key:" . $property::C1_APP_KEY,
                    "cache-control: no-cache",
                    "content-type: application/json"
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                echo "cURL Error #:" . $err;
                error_log("Error Authenticating user" . $err);
            } else {
                $identity = json_decode($response, true);
            }
            $_SESSION['name'] = $identity['name'];
            $_SESSION['firstName'] = $identity['firstName'];
            $_SESSION['lastName'] = $identity['lastName'];
            $_SESSION['userName'] = $identity['userName'];
            $_SESSION['userId'] = $identity['userId'];
        }
    }

    public function createLocalIdentity($identity) {
        require_once("../includes/config/database.php");

        $accountExists = self::findIdentityByAccountNumberAndPIN($identity['accountNumber'], $identity['pin']);
        if ($accountExists == true) {
            error_log("Account already exists");
            $result['status'] = false;
            $result['messsage'] = "Account Number Already Exists";
        } else {

            $query = "insert into identity (firstName, lastName, phone, addressLine1, addressLine2, city, province, postalcode, email, accountNumber, pin)
                                values (:firstName, :lastName, :phone, :addressLine1, :addressLine2, :city, :province, :postalcode, :email, :accountNumber, :pin)";

            try {
                $db = getConnection();
                $stmt = $db->prepare($query);
                $stmt->bindParam("firstName", $identity['firstName']);
                $stmt->bindParam("lastName", $identity['lastName']);
                $stmt->bindParam("phone", $identity['phone']);
                $stmt->bindParam("addressLine1", $identity['addressLine1']);
                $stmt->bindParam("addressLine2", $identity['addressLine2']);
                $stmt->bindParam("city", $identity['city']);
                $stmt->bindParam("province", $identity['province']);
                $stmt->bindParam("postalcode", $identity['postalCode']);
                $stmt->bindParam("email", $identity['email']);
                $stmt->bindParam("accountNumber", $identity['accountNumber']);
                $stmt->bindParam("pin", $identity['pin']);
                $stmt->execute();
                $result['status'] = true;
                $db = null;

            } catch (PDOException $e) {
                error_log($e->getMessage());
                $result['status'] = false;
                $result['message'] = "Failed to get applications: " . $e->getMessage();
                return $result;
            }
        }
        return $result;
    }
    function getLocalIdentities() {
        require_once("../includes/config/database.php");
        $query = "select * from identity";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to get local identities: " . $e->getMessage();
            return $result;
        }
        return $result;
    }

    function getIdenetityIdByC1AccountId($c1AccountId) {
        require_once("../includes/config/database.php");
        $query = "select * from identity where c1accountId = :c1AccountId";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("c1AccountId", $c1AccountId);
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

    private function findIdentityByAccountNumberAndPIN($accountNumber, $pin) {
        require_once("../includes/config/database.php");
        $query = "select * from identity where accountNumber = :accountNumber and pin = :pin";

        try {
            $db = getConnection();
            $stmt = $db->prepare($query);
            $stmt->bindParam("accountNumber", $accountNumber);
            $stmt->bindParam("pin", $pin);
            $stmt->execute();
            $stmt->fetch();
            if($stmt->rowCount() == 0) {
                $result = false;
            } else {
                $result = true;
            }
            $db = null;

        } catch(PDOException $e) {
            error_log($e->getMessage());
            $result['status'] = "failed";
            $result['error_message'] = "Failed to return approvals: " . $e->getMessage();
            return $result;
        }
        return $result;
    }

   private function getCookieDomain() {

        $url = explode(".", $_SERVER['SERVER_NAME']);
        $cookieDomain ="";
        for ($i=1; $i < sizeof($url); $i++) {
            $cookieDomain = $cookieDomain . $url[$i] . ".";
        }

        $cookieDomain =  rtrim($cookieDomain, ".");
        return $cookieDomain;
    }

}