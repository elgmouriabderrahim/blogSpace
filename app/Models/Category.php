<?php
namespace App\Models;

class Category {
    public int $id;
    public string $name;
    public function __construct($data){
        $this->id = $data['id'];
        $this->name = $data['name'];
    }

    public function getId(){return $this->id;}
    public function getName(){return $this->name;}
}
