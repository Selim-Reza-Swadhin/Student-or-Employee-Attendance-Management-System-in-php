<?php
$filepath = realpath(dirname(__FILE__));
//$filepath = realpath(__FILE__);
//$filepath = dirname(__FILE__);
//$filepath = realpath(__DIR__);
//$filepath = realpath(__CLASS__);
//echo $filepath;
include_once ($filepath.'/../config/config.php');
//include_once ('./../config/config.php');
//var_dump($link);
?>

<?php
Class Database{
    public $host   = DB_HOST;
    public $user   = DB_USER;
    public $pass   = DB_PASS;
    public $dbname = DB_NAME;


    public $link;
    public $error;


    public function __construct(){
        $this->connectDB();
    }

    private function connectDB(){
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
        if(!$this->link){
            $this->error ="Connection fail".$this->link->connect_error;
            return false;
        }
    }

    // Select or Read data

    public function select($query){
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result->num_rows > 0){
            return $result;
        } else {
            return false;
        }
    }

    // Insert data
    public function insert($query){
        $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($insert_row){
            //header("Location: index.php?msg=".urlencode('Data Inserted successfully.'));
            //exit();
            return $insert_row;
        } else {
            //die("Error :(".$this->link->errno.")".$this->link->error);
            return false;
        }
    }

    // Update data
    public function update($query){
        $update_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($update_row){
            //header("Location: index.php?msg=".urlencode('Data Updated successfully.'));
            //exit();
            return $update_row;
        } else {
            //die("Error :(".$this->link->errno.")".$this->link->error);
            return false;
        }
    }

    // Delete data
    public function delete($query){
        $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
        if($delete_row){
            //header("Location: index.php?msg=".urlencode('Data Deleted successfully.'));
            //exit();
            return $delete_row;
        } else {
            //die("Error :(".$this->link->errno.")".$this->link->error);
            return false;
        }
    }



}

