<?
require_once $_SERVER['DOCUMENT_ROOT']."/engine/class/collection/User.collection.php";
require_once $_SERVER['DOCUMENT_ROOT']."/engine/class/collection/Post.collection.php";

require_once $_SERVER['DOCUMENT_ROOT']."/engine/class/Shared.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/engine/class/User.class.php";
require_once $_SERVER['DOCUMENT_ROOT']."/engine/class/Post.class.php";

class Core{
    protected $shared;
    function __construct($db, $config, $locale = "en")
    {
        $this->shared = new Shared($db,$config,$locale); 
        $this->config = $config;
        $this->users = new UserCollection($this->shared);
        $this->posts = new PostCollection($this->shared);
    }
}

?>