<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Penalite_equipe extends Model
{
    use HasFactory;
    protected $table = 'penalite_equipe';
    protected $keyType = 'string';

    public function getList(){
        $result = DB::select("SELECT * FROM penalite_equipe");
        return $result;
    }

    public function insert($data){
        DB::table('penalite_equipe')->insert([
            'equipe' => $data['equipe'],
'etape' => $data['etape'],
'penalite' => $data['penalite'],

        ]);
    }

    public function modifier($id, $data){
        DB::table('penalite_equipe')
            ->where('id', $id)// asina penalite_equipe ao arinan'ny id ra misy nomVariable ao arinan'le id @ base
            ->update([
                'equipe' => $data['equipemodal'],
'etape' => $data['etapemodal'],
'penalite' => $data['penalitemodal'],

            ]);
    }


}
