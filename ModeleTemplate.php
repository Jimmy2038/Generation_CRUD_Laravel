<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class [#Classe] extends Model
{
    use HasFactory;
    protected $table = '[#variable]';
    protected $keyType = 'string';

    public function getList(){
        $result = DB::select("SELECT * FROM [#variable]");
        return $result;
    }

    public function insert($data){
        DB::table('[#variable]')->insert([
            [#champ]
        ]);
    }

    public function modifier($id, $data){
        DB::table('[#variable]')
            ->where('id', $id)// asina [#variable] ao arinan'ny id ra misy nomVariable ao arinan'le id @ base
            ->update([
                [#champmodale]
            ]);
    }


}
