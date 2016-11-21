<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    public function addPerson($data){
        return $result = $this->insert($data);
        
    }
    
    public function searchPerson($first_name, $last_name, $keyword){
        return $this->where('first_name', 'LIKE', '%'.$first_name.'%')->where('last_name', 'LIKE', '%'.$last_name.'%')->where('keywords', 'LIKE', '%'.$keyword.'%')->get();
    }
}
