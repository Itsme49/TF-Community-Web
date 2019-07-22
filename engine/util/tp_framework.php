<?
require_once $_SERVER['DOCUMENT_ROOT']."./engine/util/tp_framework.php";
function render($name, $tags = array(), $brackets = array()){
    global $locale;
    global $template;
    // Loading Template Name
    $content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/templates/$template/$name.tpl");

    // Working with brackets
    foreach($brackets as $bracket=>$value){
        $content = preg_replace("/\[$bracket\](.*)\[\/$bracket\]/sU",$value?"$1":"",$content);
    }
    // Working with custom tags
    foreach($tags as $tag=>$value){
        $content = preg_replace("/\{$tag\}/",$value,$content);
    }
    
    // Working with Localisation
    preg_match_all('/\#(\w*)/',$content,$Locale_Keys);
    $Locale_Keys = $Locale_Keys[1];
    foreach($Locale_Keys as $key){
        if(isset($key)) $content = preg_replace("/\#$key/",$locale[$key],$content,1);
    }
    return $content;
}
?>