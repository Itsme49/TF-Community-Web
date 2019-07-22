<?
require_once $_SERVER['DOCUMENT_ROOT']."./engine/util/tp_framework.php";
// Working with content

$_DATA = array(
    'category' => 0,
    'page_name' => ''
);

// *****************
// Check if config has redirect for this page
// *****************

if(isset($_CONFIG["redirects"][$_GET["page"]])) header("Location: ".$_CONFIG["redirects"][$_GET["page"]]);

// *****************
// Main Page
// *****************
if(empty($_GET["page"]) || $_GET["page"] == "blog"){ 
    $Posts = $Core->posts->getPublishedPosts(10,CAT_BLOG,$_GET["offset"]);
    $_DATA['category'] = CAT_BLOG;
    $_DATA['page_name'] = '#PreMain_Nav_Blog';
    foreach($Posts as $Post){
        $Date = new DateTime($Post->published);
        $Content = $Content.render(
            "post",
            array(
                'title' => $Post->title,
                'story' => $Post->story,
                'author' => $Post->author,
                'date' => strftime("%B %d, %Y", $Date->getTimestamp())
            )
        );
    }
// *****************
// Updates Blog Page
// *****************
}else if($_GET["page"] == "updates"){
    $Posts = $Core->posts->getPublishedPosts(10,CAT_UPDATES,$_GET["offset"]);
    $_DATA['category'] = CAT_UPDATES;
    $_DATA['page_name'] = '#PreMain_Nav_Updates';
    foreach($Posts as $Post){
        $Date = new DateTime($Post->published);
        $Content = $Content.render(
            "post",
            array(
                'title' => $Post->title,
                'story' => $Post->story,
                'author' => $Post->author,
                'date' => strftime("%B %d, %Y", $Date->getTimestamp())
            )
        );
    }
// *****************
// News Blog Page
// *****************
}else if($_GET["page"] == "news"){
    $Posts = $Core->posts->getPublishedPosts(10,CAT_NEWS,$_GET["offset"]);
    $_DATA['category'] = CAT_NEWS;
    $_DATA['page_name'] = '#PreMain_Nav_News';
    foreach($Posts as $Post){
        $Date = new DateTime($Post->published);
        $Content = $Content.render(
            "post",
            array(
                'title' => $Post->title,
                'story' => $Post->story,
                'author' => $Post->author,
                'date' => strftime("%B %d, %Y", $Date->getTimestamp())
            )
        );
    }
}
$Render = render(
    "main",
    array(
        'username' => isset($User)?$User->name:NULL,
        'avatar' => isset($User)?$User->avatar:NULL,
        'monthly' => '412,425',
        'headers' => format('<title>#Website_Title %s %s</title>',array($_CONFIG["separator"],$_DATA['page_name'])),
        "content" => $Content,
        'blog' => $_DATA['category']==CAT_BLOG?"focus":"",
        'updates' => $_DATA['category']==CAT_UPDATES?"focus":"",
        'news' => $_DATA['category']==CAT_NEWS?"focus":"",
        'vue' => $PRODUCTION?"https://cdn.jsdelivr.net/npm/vue":"https://cdn.jsdelivr.net/npm/vue/dist/vue.js",
        "language" => $_COOKIE["locale"]
    ),
    array(
        'LOGIN' => isset($User)
    )
);
echo $Render;
?>