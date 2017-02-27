<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\Services\TwitterOAuth\TwitterOAuth;
use App\Services\TwitterOAuth\Config;

class HomeController extends Controller {

    /**
     * *
     */
    public function index() {
        session_start();
        $connection = new TwitterOAuth("zgvZmTLYmKmXo6XSDDNElzg9Y", "Y0LZ14f0J4P6kM4iPYuogRl6SyXHEPIF9sTxMHRdLauBIE1C92");
        $callback = route("twitter_login");
        $access_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $callback));
        $_SESSION['oauth_token'] = $access_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
        $twitterUrl = $connection->url('oauth/authorize', array('oauth_token' => $access_token['oauth_token']));
        $loged = "false";
        if (isset($_REQUEST['oauth_verifier']))
            $loged = "true";
        return view('home', ['twitterUrl' => $twitterUrl, 'twitterLogedIn' => $loged]);
    }


    public function facebookLogin() {
        if (isset($_REQUEST["name"]) && isset($_REQUEST["id"])) {
            $user = new User;
            $name = $_REQUEST["name"] . "-" . $_REQUEST["id"];
            $user->name = $name;
            $user->type ="Facebook";
            $count = User::where('name', $name)->count();
            if ($count === 0) {
                $user->save();
            }
            return "true";
        }
        return "false";
    }

    public function twitterLogin() {
        session_start();
        $request_token = [];
        $request_token['oauth_token'] = $_SESSION['oauth_token'];
        $request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];
        if (isset($_REQUEST['denied']) or ( isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] !== $_REQUEST['oauth_token'])) {
            // Abort! Something is wrong.
            $loged = "false";
            $connection = new TwitterOAuth("zgvZmTLYmKmXo6XSDDNElzg9Y", "Y0LZ14f0J4P6kM4iPYuogRl6SyXHEPIF9sTxMHRdLauBIE1C92");
            $callback = route("twitter_login");
            $access_token = $connection->oauth('oauth/request_token', array('oauth_callback' => $callback));
            $_SESSION['oauth_token'] = $access_token['oauth_token'];
            $_SESSION['oauth_token_secret'] = $access_token['oauth_token_secret'];
            $twitterUrl = $connection->url('oauth/authorize', array('oauth_token' => $access_token['oauth_token']));
            return view('home', ['twitterUrl' => $twitterUrl, 'twitterLogedIn' => $loged]);
        } else if (( isset($_REQUEST['oauth_token']) && $request_token['oauth_token'] == $_REQUEST['oauth_token'])) {
            return view('home', ['twitterUrl' => "#", 'twitterLogedIn' => "true"]);
        }
        $connection = new TwitterOAuth("zgvZmTLYmKmXo6XSDDNElzg9Y", "Y0LZ14f0J4P6kM4iPYuogRl6SyXHEPIF9sTxMHRdLauBIE1C92", $request_token['oauth_token'], $request_token['oauth_token_secret']);
        $access_token = $connection->oauth("oauth/access_token", ["oauth_verifier" => $_REQUEST['oauth_verifier']]);
        $_SESSION['access_token'] = $access_token;
        $loged = "false";
        if (isset($access_token['oauth_token']) && $access_token['oauth_token_secret']) {
            $connection = new TwitterOAuth("zgvZmTLYmKmXo6XSDDNElzg9Y", "Y0LZ14f0J4P6kM4iPYuogRl6SyXHEPIF9sTxMHRdLauBIE1C92", $access_token['oauth_token'], $access_token['oauth_token_secret']);
            //gettring info    
            $userLogin = $connection->get("account/verify_credentials");
            $user = new User;
            $name = $userLogin->name . "-" . $userLogin->screen_name;
            $user->name = $name;
            $user->type ="Twitter";
            $count = User::where('name', $name)->count();
            if ($count === 0) {
                $user->save();
            }
            $loged = "true";
        }
        return view('home', ['twitterUrl' => "#", 'twitterLogedIn' => $loged]);
    }

}
