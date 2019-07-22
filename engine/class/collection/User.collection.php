<?
class UserCollection{
    protected $shared;
    function __construct($shared){
        $this->__cache = array();
        $this->shared = $shared;
    }

    function find($param,$query, $isDiscord = false){
        if($isDiscord){
            $q = $this->shared->db->query("SELECT * FROM `tf_users` WHERE JSON_CONTAINS(`discord`,'{\"$param\":\"$query\"}')");
        }else{
            $q = $this->shared->db->query("SELECT * FROM `tf_users` WHERE `$param` = '$query'");
        }
        if(mysqli_num_rows($q) == 0) return NULL;
        return new User(mysqli_fetch_assoc($q),$this->shared);
    }

    function create($data){
        $token = md5(time().$data["steamid"]).md5(time());
        $this->shared->db->query(format("INSERT INTO `tf_users` (`steamid`, `name`,`avatar`, `token`) VALUES ('%s','%s','%s','%s')",array($data["steamid"],addslashes($data["name"]),$data["avatar"],$token)));
        return $token;
    }
}
?>