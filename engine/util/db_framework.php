<?
class Database{
    protected $SQL;
    function __construct($SQL)
    {
        $this->SQL = $SQL;
    }
    function query($q){
        if(DEBUG == 1){
            echo "Query: $q</br>";
        }
        return mysqli_query($this->SQL,$q);
    }
    function getRow($q){
        return mysqli_fetch_assoc($this->query($q));
    }
    function getAllRows($q){
        return mysqli_fetch_all($this->query($q),MYSQLI_ASSOC);
    }
}

$SQL = mysqli_connect(
    $_CONFIG["mysql"]["hostname"],
    $_CONFIG["mysql"]["username"],
    $_CONFIG["mysql"]["password"],
    $_CONFIG["mysql"]["database"]
);
mysqli_set_charset($SQL,"utf8");
$Database = new Database($SQL);
?>