<?php
namespace App\Models;

class Author extends User {

    public function __construct(array $data){
        parent::__construct($data['role'] ? $data:[...$data, 'role' => 'Author']);
    }

}
