<?
// Ban Bits
define("BAN_OVERALL",(1<<0)); // Overall System Ban
define("BAN_WEBSITE_ACCESS",(1<<1)); // Site Access Ban

// Categories
define("CAT_BLOG", 0);
define("CAT_UPDATES", 1);
define("CAT_NEWS", 2);

// Functions
function format($string, $args){
    foreach($args as $k=>$v){
        $string = preg_replace('/%s/', $v, $string, 1);
    }
    return $string;
}
?>