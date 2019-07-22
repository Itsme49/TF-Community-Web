<?
class Post{
    function __construct($data, $shared){
        $this->shared = $shared;
        $this->id = $data["id"];
        $this->title = $data["title"];
        $this->story = $data["story"];
        $this->category = $data["category"];
        $this->created = $data["created"];
        $this->published = $data["published"];
        $this->author = $data["author"];
        $this->views = $data["views"];
        
        // Test if localisation present
        if($this->shared->locale != "en")$loc = $this->shared->db->getRow(format("SELECT * FROM `tf_posts_locales` WHERE `id` = '$this->id' AND `locale` = '%s'",array($this->shared->locale)));
        if(isset($loc)){
            $this->story = $loc["story"];
            $this->title = $loc["title"];
        }
    }
}
?>