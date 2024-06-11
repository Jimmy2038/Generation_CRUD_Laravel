<?php

namespace App\Http\Controllers;

use App\Models\Penalite_equipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class Penalite_equipeController extends Controller
{

    public function insert()
    {
        $penalite_equipe = new Penalite_equipe();
        $penalite_equipes = $penalite_equipe::paginate(5);
        $equipe=DB::select("SELECT * FROM equipe");$etape=DB::select("SELECT * FROM etape");
        return view('penalite_equipe.penalite_equipe', [
            'penalite_equipes' => $penalite_equipes,
            'equipes' => $equipe,'etapes' => $etape,
        ]);
    }

    public function create(Request $request)
    {
        $data = Validator::make($request->all(),[
            'equipe' => 'required',
'etape' => 'required',
'penalite' => 'required',

        ]);

        
        if ($data->fails()){
            Session::flash('ajouter','ajout');
            return redirect()->route('penalite_equipe.ressource')->withErrors($data->errors());
        }
        
        $penalite_equipe = new Penalite_equipe();
        $penalite_equipe->insert($data);

        return redirect()->route('penalite_equipe.ressource')->with('success', 'penalite_equipe créé avec succès!');
    }

    public function modifier(Request $request)
    {
        $id = $request->input('idpenalite_equipe');// afaka asina an'io ao arinan'ny idpenalite_equipe
        $data = Validator::make($request->all(),[
            'equipemodal' => 'required',
'etapemodal' => 'required',
'penalitemodal' => 'required',

        ]);

        if ($data->fails()){
            Session::flash('modifier','modif');
            return redirect()->route('penalite_equipe.ressource')->withErrors($data->errors());
        }

        $penalite_equipe = new Penalite_equipe();
        $penalite_equipe->modifier($id, $data);

        return redirect()->route('penalite_equipe.ressource')->with('success', 'penalite_equipe modifié avec succès!');
    }
    public function destroy($id)
    {
        try {
            DB::table('penalite_equipe')
                ->where('id', $id)// afaka asina an'io ao arinan'ny idpenalite_equipe
                ->delete();

            return redirect()->route('penalite_equipe.ressource')->with('success', 'penalite_equipe supprimé avec succès!');
        } catch (\Exception $e) {
            // Gestion de l'erreur ici
            return redirect()->route('penalite_equipe.ressource')->with('error', 'Une erreur est survenue lors de la suppression du penalite_equipe.');
        }
    }


}
