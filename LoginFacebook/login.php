<?php 
	require_once 'config.php';

	if (isset($_SESSION['access_token'])) {
		header ('Location: index.php');
		exit();
	}

    $redirectURL = 'http://caramba.space/LoginFacebook/fb-callback.php';
    $permissions = ['user_posts'];
    $loginURL = $helper->getLoginUrl($redirectURL, $permissions);

    echo '<a href="' . htmlspecialchars($loginURL) . '">Log in with Facebook!</a>';

