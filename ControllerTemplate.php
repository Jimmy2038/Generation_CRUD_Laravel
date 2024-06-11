<?php

namespace App\Http\Controllers;

use App\Models\[#Classe];
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class [#Classe]Controller extends Controller
{

    public function insert()
    {
        $[#variable] = new [#Classe]();
        $[#variable]s = $[#variable]::paginate(5);
        [#select]
        return view('[#variable].[#variable]', [
            '[#variable]s' => $[#variable]s,
            [#selects]
        ]);
    }

    public function create(Request $request)
    {
        $data = Validator::make($request->all(),[
            [#champ]
        ]);

        
        if ($data->fails()){
            Session::flash('ajouter','ajout');
            return redirect()->route('[#variable].ressource')->withErrors($data->errors());
        }
        
        $[#variable] = new [#Classe]();
        $[#variable]->insert($data);

        return redirect()->route('[#variable].ressource')->with('success', '[#variable] créé avec succès!');
    }

    public function modifier(Request $request)
    {
        $id = $request->input('id[#variable]');// afaka asina an'io ao arinan'ny id[#variable]
        $data = Validator::make($request->all(),[
            [#champmodale]
        ]);

        if ($data->fails()){
            Session::flash('modifier','modif');
            return redirect()->route('[#variable].ressource')->withErrors($data->errors());
        }

        $[#variable] = new [#Classe]();
        $[#variable]->modifier($id, $data);

        return redirect()->route('[#variable].ressource')->with('success', '[#variable] modifié avec succès!');
    }
    public function destroy($id)
    {
        try {
            DB::table('[#variable]')
                ->where('id', $id)// afaka asina an'io ao arinan'ny id[#variable]
                ->delete();

            return redirect()->route('[#variable].ressource')->with('success', '[#variable] supprimé avec succès!');
        } catch (\Exception $e) {
            // Gestion de l'erreur ici
            return redirect()->route('[#variable].ressource')->with('error', 'Une erreur est survenue lors de la suppression du [#variable].');
        }
    }


}
