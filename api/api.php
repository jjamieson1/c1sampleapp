<?php
session_start();
include "../includes/config/config.php";
include "../Slim/Slim.php";
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


$app->get('/getstatus/:applicationId/:identityId', 'status');
$app->run();


function status($applicationId, $identityId) {
  $app = \Slim\Slim::getInstance();

  include "../classes/status.php";
  $status = new Status();

  $statuses = $status->getStatus($identityId, $applicationId);


    $app->response()->setStatus(200);
    $app->response->headers->set('Content-Type', 'application/json');
    $app->response()->body(json_encode($statuses));

    return;
}
?>
