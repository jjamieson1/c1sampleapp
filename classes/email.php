<?php

class Email {

    function getEmails() {

        require_once ("../includes/config/config.php");
        $property = new Properties();

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_PORT => $property::C1_PORT,
            CURLOPT_URL => $property::C1_BASEURL."/sp/id1/api/v1/identities/".$_SESSION['userId']."/emails",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "api-key: " . $property::C1_API_KEY,
                "app-key:" . $property::C1_APP_KEY,
                "cache-control: no-cache",
                "content-type: application/json",
                "postman-token: a24e364c-df68-9a75-e3f0-6aed64affa4c"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        }
            return json_decode($response, true);

    }
}