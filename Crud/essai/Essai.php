<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Essai extends Model
{
    use HasFactory;
    protected $table = 'essai';

    public function getList(){
        $result = DB::select("SELECT * FROM essai");
        return $result;
    }

    public function insert($data){
        DB::table('essai')->insert([
            'designation' => $data['designation'],

        ]);
    }

    public function modifier($id, $data){
        DB::table('essai')
            ->where('idessai', $id)
            ->update([
                'designation' => $data['designationmodal'],

            ]);
    }


}
