<?php
    include_once("ship.php");
    function TableSort($type, $dir, $data){
        usort($data, function($a,$b) use($dir, $type){
            if ($dir == "up") {
                return $a->$type <=> $b->$type;
            }
            else{
                return $b->$type <=> $a->$type;
            }
        });
        return $data;
    }
?>