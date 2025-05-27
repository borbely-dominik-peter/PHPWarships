<?php 
    class Ship{
        public function __construct(public ?int $id,public string $name, public string $class, public string $type, public int $launched, public string $MainGunCaliber, public string $country) {
            
        }
    }
?>