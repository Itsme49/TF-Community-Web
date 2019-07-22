<?
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
define("INCLUDED",1);
define("DEBUG", 0);
if(DEBUG == 1) $time = round(microtime(true) * 1000);
$PRODUCTION = false;
require_once $_SERVER['DOCUMENT_ROOT']."./config.php";
require_once $_SERVER['DOCUMENT_ROOT']."./engine/util/constants.php";
if($_SERVER['HTTP_HOST'] == $_CONFIG["website_domain"]){
	if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
		header("Location: https://".$_SERVER['HTTP_HOST']);
    }
    $PRODUCTION = true;
}
// *****************
// Check if client changes locale
// *****************

if($_GET["page"] == "language") {
    setcookie("locale", $_GET["locale"], time()+60*60*24*120,'/');
    $_COOKIE["locale"]=$_GET["locale"];
    header("location:".(isset($_GET['redirect'])?$_GET['redirect']:"/"));
}

if(!file_exists(format($_SERVER['DOCUMENT_ROOT']."/translations/locale_%s.json",array($_COOKIE["locale"]))) || !isset($_COOKIE["locale"])){
    setcookie("locale", "en", time()+60*60*24*120,'/');
    $_COOKIE["locale"]="en";
}
$locale = json_decode(file_get_contents(format($_SERVER['DOCUMENT_ROOT']."./translations/locale_%s.json",array($_COOKIE["locale"]))),true);

require_once $_SERVER['DOCUMENT_ROOT']."./engine/util/db_framework.php";
require_once $_SERVER['DOCUMENT_ROOT']."./engine/class/Core.class.php";
$Core = new Core($Database, $_CONFIG,$_COOKIE["locale"]);
if(isset($_COOKIE["token"])) $_SESSION["token"] = $_COOKIE["token"];
if(!isset($_COOKIE["token"])) $_SESSION["token"] = NULL;

if(isset($_SESSION["token"])){
    $User = $Core->users->find('token', $_SESSION["token"]);
    if(!isset($User)) {
        setcookie("token",null,0,'/');
        die("Invalid Token");
    }
    if($User->checkBan(BAN_WEBSITE_ACCESS)) die("You are banned.");
}
// Getting Template
if(!file_exists(format($_SERVER['DOCUMENT_ROOT']."/templates/%s/main.tpl",array($_CONFIG["template"])))){
    $_CONFIG["template"] = "default";
}
$template = $_CONFIG["template"];
require_once $_SERVER['DOCUMENT_ROOT']."./engine/renderer.php";
mysqli_close($SQL);
if(DEBUG == 1) echo "<b class=\"white\">Time to load: ".(round(microtime(true) * 1000) - $time)."ms</b>";
?>