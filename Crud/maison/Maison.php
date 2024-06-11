<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Maison extends Model
{
    use HasFactory;
    protected $table = 'maison';
    protected $keyType = 'string';

    public function getList(){
        $result = DB::select("SELECT * FROM maison");
        return $result;
    }

    public function insert($data){
        DB::table('maison')->insert([
            'designation' => $data['designation'],
'description' => $data['description'],
'surface' => $data['surface'],
'duree' => $data['duree'],

        ]);
    }

    public function modifier($id, $data){
        DB::table('maison')
            ->where('id', $id)// asina maison ao arinan'ny id ra misy nomVariable ao arinan'le id @ base
            ->update([
                'designation' => $data['designationmodal'],
'description' => $data['descriptionmodal'],
'surface' => $data['surfacemodal'],
'duree' => $data['dureemodal'],

            ]);
    }


}
