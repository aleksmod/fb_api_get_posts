<?php
require_once 'config.php';
error_reporting(E_ALL & ~E_NOTICE);

    try{
        $accessToken = $helper->getAccessToken();
    } catch (\Facebook\Exceptions\FacebookResponseException $e) {
        echo "Responce Exeption: " . $e->getMessage();
        exit();
    } catch (\Facebook\Exceptions\FacebookSDKException $e) {
        echo "SDK Exeption: " . $e->getMessage();
        exit();
    }

    if (!$accessToken) {
        header('Location: login.php');
        exit();
    }
    // get longlived access token
    $oAuth2Client = $FB->getOAuth2Client();
    if (!$accessToken->isLongLived()) {
        $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);

    }

    $responce = $FB->get("me?fields=id,name,posts.limit(5){created_time,picture,description,likes.summary(true),shares,permalink_url}", $accessToken);
    $data = $responce->getGraphNode()->asArray();

    $userData = [];
    $userData['id'] = $data['id'];
    $userData['name'] = $data['name'];
    $userData['posts'] = [];

    foreach ($data['posts'] as $post) {
        $created_time = (array)$post['created_time'];
        $userData['posts'][] = [
            'created_time' => $created_time['date'],
            'picture' => $post['picture']?:'default.img',
            'description' => $post['description']?:'without description',
            'likes' => count($post['likes'])?:0,
            'shares' => $post['shares']?:0,
            'permalink_url' => $post['permalink_url'],
        ];
}

    $_SESSION['userData'] = $userData;
    $_SESSION['accessToken'] = (string) $accessToken;
    header('Location: index.php');
    exit();


