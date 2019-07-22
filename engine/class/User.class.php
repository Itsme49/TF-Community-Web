<?
class User{
    function __construct($data, $shared){
        $this->shared = $shared;
        $this->id = $data["id"];
        $this->steamid = $data["steamid"];
        $this->avatar = $data["avatar"];
        $this->name = $data["name"];
        $this->token = $data["token"];

        $this->bans = $data["bans"];
        $this->admin = $data["admin"];
        $this->verified = $data["verified"];

        $this->discord = json_decode($data["discord"],true);
        $this->youtube = $data["youtube"];
        $this->twitch = $data["twitch"];
    }

    function checkBan($bit)
    {
        if($this->bans & BAN_OVERALL) return true;
        if($this->bans & $bit) return true;
        return false;
    }

    function update($name, $avatar){
        $this->shared->db->query("UPDATE `tf_users` SET `name` = '$name', `avatar` = '$avatar' WHERE `tf_users`.`id` = $this->id");
        $this->name = $name;
        $this->avatar = $avatar;
    }
    function setAdmin($bits)
    {
        $this->shared->db->query("UPDATE `tf_users` SET `admin` = '$bits'");
        $this->admin = $bits;
    }
    function suspend($feature)
    {
        $this->bans |= $feature;
        $this->shared->db->query("UPDATE `tf_users` SET `bans` = '$feature'");
    }
    function pardon($feature)
    {
        $this->bans &= ~$feature;
        $this->shared->db->query("UPDATE `tf_users` SET `bans` = '$feature'");
    }
    function setDiscord($discord){
        $this->shared->db->query(format("UPDATE `tf_users` SET `discord` = '%s'",array(json_encode($discord))));
        $this->discord = $discord;
    }
    function setYoutube($youtube){
        $this->shared->db->query("UPDATE `tf_users` SET `youtube` = '$youtube'");
        $this->youtube = $youtube;
    }
}
?>