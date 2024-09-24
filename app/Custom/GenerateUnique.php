<?php
namespace App\Custom;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait GenerateUnique
{
    public function uniqueRef(){
        $id = mt_rand();
        return Str::padLeft($id,'10','0');
    }

    public function createUniqueRef($table,$column){
        $id = $this->uniqueRef();
        return DB::table($table)->where($column,$id)->first() ? $this->createUniqueRef($table,$column):$id;
    }
    public function generateId($table,$column){
        $id = $this->uniqueRef();
        return DB::table($table)->where($column,$id)->first() ? $this->createUniqueRef($table,$column):$id;
    }
}
