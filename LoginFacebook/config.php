<?php
session_start();

require_once 'Facebook/autoload.php';

	$FB = new \Facebook\Facebook([
		  'app_id' => '1486081934773869',
		  'app_secret' => '7923c142a5ae5adbebeab90d5f07d095',
		  'default_graph_version' => 'v2.11',
		  ]);

	$helper = $FB->getRedirectLoginHelper();

