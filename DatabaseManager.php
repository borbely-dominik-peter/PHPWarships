<?php 

    include_once("ship.php");
    class DatabaseManager{
        public $conn;
        
        public function __construct($hostname, $username, $password, $database) {
            $this->conn = new mysqli($hostname,$username,$password,$database);
            if ($this->conn->connect_error) {
                die("Connection failed");
            }
        }

        public function GetAllData(){
            $sql = "SELECT * from ships";
            $result =$this->conn->query($sql);
            $ResList = [];
            while (($row = $result->fetch_object()) != false) {
                $ResList[] = new Ship($row->id,$row->name,$row->class,$row->type,$row->launched,$row->main_gun_caliber,$row->country);
            }
            return $ResList;
        }

        public function AddToDB($NewShip){
            $sql = "INSERT INTO ships(name,class,type,launched,main_gun_caliber,country) VALUES 
            (
            '$NewShip->name',
            '$NewShip->class',
            '$NewShip->type',
            $NewShip->launched,
            '$NewShip->MainGunCaliber',
            '$NewShip->country'
            );";
            $this->conn->query($sql);
        }

        public function RemoveFromDB($id){
            $sql = "DELETE FROM ships WHERE id=$id;";
            $this->conn->query($sql);
        }

        public function ModifyinDB($NewShip){
            $sql = "UPDATE ships SET 
                name='$NewShip->name',
                class='$NewShip->class',
                type='$NewShip->type',
                launched=$NewShip->launched,
                main_gun_caliber='$NewShip->MainGunCaliber',
                country='$NewShip->country'
                WHERE id=$NewShip->id
            ;";
            $this->conn->query($sql);
            echo $sql;
        }
    } 
?>