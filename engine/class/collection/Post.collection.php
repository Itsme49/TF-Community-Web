<?
class PostCollection{
    protected $shared;
    function __construct($shared){
        $this->__cache = array();
        $this->shared = $shared;
    }

    function find($param,$query){
        $q = $this->shared->db->query("SELECT * FROM `tf_posts` WHERE `$param` = '$query'");
        if(mysqli_num_rows($q) == 0) return NULL;
        return new Post(mysqli_fetch_assoc($q),$this->shared);
    }

    function getPosts($count,$category,$offset = 0)
    {
        if(!isset($offset))$offset = 0;
        $offset*=10;
        $__posts = $this->shared->db->getAllRows("SELECT * FROM `tf_posts` WHERE `category` = $category LIMIT $count OFFSET $offset");
        $posts = array();
        foreach($__posts as $k => $v){
            array_push($posts, new Post($v,$this->shared));
        }
        return $posts;
    }

    function getPublishedPosts($count,$category,$offset = 0)
    {
        if(!isset($offset))$offset = 0;
        $offset*=10;
        $__posts = $this->shared->db->getAllRows("SELECT * FROM `tf_posts` WHERE `category` = $category AND `published` IS NOT NULL LIMIT $count OFFSET $offset");
        $posts = array();
        foreach($__posts as $k => $v){
            array_push($posts, new Post($v,$this->shared));
        }
        return $posts;
    }
    function getUnpublishedPosts($count,$category,$offset = 0)
    {
        if(!isset($offset))$offset = 0;
        $offset*=10;
        $__posts = $this->shared->db->getAllRows("SELECT * FROM `tf_posts` WHERE `category` = $category AND `published` IS NULL LIMIT $count OFFSET $offset");
        $posts = array();
        foreach($__posts as $k => $v){
            array_push($posts, new Post($v,$this->shared));
        }
        return $posts;
    }

    function create($data){
        $this->shared->db->query(format(
            "INSERT INTO `tf_posts` (`title`, `story`, `category`,`author`) VALUES ('%s','%s','%s','%s')",
            array(
                addslashes($data["title"]),
                addslashes($data["story"]),
                addslashes($data["author"]),
                $data["category"]
            )
        ));
    }
}
?>