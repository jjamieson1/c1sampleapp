<?php
class Notification {

    function sendNotification($identityId, $post) {
        require_once ("../includes/config/config.php");
        $property = new Properties();

        $postBody['identityId'] = $identityId;
        $postBody['subject'] = $post['subject'];
        $postBody['body'] = $post['body'];
        $postBody['shortbody'] = $post['short-body'];
        $postBody['notificationCategoryType'] = "BUSINESS";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => $property::C1_PORT,
            CURLOPT_URL => $property::C1_BASEURL."/sp/id1/api/v1/identities/".$identityId."/notifications",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "api-key: " . $post['api_key'],
                "app-key:" . $post['app_key'],
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: 355a2703-6b69-079e-0a20-dadb103c343f"
            ),
        ));
        curl_setopt($curl, CURLOPT_HEADER  , true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postBody));
        $response = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if($httpcode == 200) {
            $result['status'] = true;
            $result['message'] = "Notification Sent Successfully";
        } else {
            $result['status'] = false;
            $result['message'] = $response;
        }
        curl_close($curl);

        return  $result;

    }
}