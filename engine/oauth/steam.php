<?php
require_once $_SERVER['DOCUMENT_ROOT']."/config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/engine/util/constants.php";
require_once $_SERVER['DOCUMENT_ROOT']."/engine/util/db_framework.php";
require_once $_SERVER['DOCUMENT_ROOT']."/engine/class/Core.class.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/engine/oauth/steam/openid.php';
$Core = new Core($Database, $_CONFIG);

if(isset($_GET["logout"])){
    setcookie("token",NULL,time()-60,'/');
    Header("Location: /");
    die();
}

try
{
    $openid = new LightOpenID($_SERVER['HTTP_HOST'].'/');
    if(!$openid->mode)
    {
        if(!isset($_SESSION["token"]))
        {
            $openid->identity = 'http://steamcommunity.com/openid/?l=english';    // This is forcing english because it has a weird habit of selecting a random language otherwise
            header('Location: ' . $openid->authUrl());
        }else{
            Header("Location: /");
        }
    }
    elseif($openid->mode == 'cancel')
    {
        echo 'User has canceled authentication!';
    }
    else
    {
        if($openid->validate())
        {
                $id = $openid->identity;
                $steamid = explode("/", $id)[5];

                $url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".$_CONFIG["steam_key"]."&steamids=$steamid";
                $json_object= file_get_contents($url);
                $json_decoded = json_decode($json_object);

                $json_decoded->response->players[0]->personaname=addslashes($json_decoded->response->players[0]->personaname);

                $User = $Core->users->find('steamid',$steamid);
                //Testing new User
                if(!$User){
                    $token = $Core->users->create(array(
                        'steamid'=>$steamid,
                        'name'=>$json_decoded->response->players[0]->personaname,
                        'avatar'=>$json_decoded->response->players[0]->avatarfull
                    ));
                }else{
                    $User->update(
                        $json_decoded->response->players[0]->personaname,
                        $json_decoded->response->players[0]->avatarfull
                    );
                    $token = $User->token;
                }
                setcookie("token",$token,time()+60*60*24*30,"/");

                if(isset($_GET["redirect"])){
                    Header("Location: ".$_GET["redirect"]);
                }else{
                    Header("Location: /");
                }
        }
        else
        {
                echo "User is not logged in.\n";
        }
    }
}
catch(ErrorException $e)
{
    echo $e->getMessage();
}
