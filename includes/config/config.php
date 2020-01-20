<?php

class Properties {

  const DBHOST = "localhost";
  const DBUSER = "root";
  const DBPASS = "Today123$$";
  const DBNAME = "c1_sample_app";
  const SITE = "http://c1sampleapp.c1demo.vivvo.com";
  const C1_BASEURL= "http://internal.c1demp.vivvo.com";
  const C1_PORT="80";
  const C1_LOGIN_URL = "http://c1demo.vivvo.com";
  const C1_APP_KEY = "d3e05433-8774-4a53-9e0a-cd2e810c8aa2";
  const C1_API_KEY = "da5a168f-3298-4942-be6c-5867032a7c00";
  const COOKIE = "SaskatchewanSSO";


  function getSite() {
       echo  self::SITE;
   }
}
 ?>
