<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Maison_traveau extends Model
{
    use HasFactory;
    protected $table = 'maison_traveau';
    protected $keyType = 'string';

    public function getList(){
        $result = DB::select("SELECT * FROM maison_traveau");
        return $result;
    }

    public function insert($data){
        DB::table('maison_traveau')->insert([
            'designation' => $data['designation'],
'id_traveau' => $data['id_traveau'],

        ]);
    }

    public function modifier($id, $data){
        DB::table('maison_traveau')
            ->where('id', $id)// asina maison_traveau ao arinan'ny id ra misy nomVariable ao arinan'le id @ base
            ->update([
                'designation' => $data['designationmodal'],
'id_traveau' => $data['id_traveaumodal'],

            ]);
    }


}
