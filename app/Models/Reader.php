<?php
namespace App\Models;

class Reader extends User
{
    public function __construct(array $data){
        parent::__construct(isset($data['role']) ? $data:[...$data, 'role' => 'Reader']);
    }
}
