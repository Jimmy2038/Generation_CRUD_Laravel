<?php

namespace App\Http\Controllers;

use App\Models\Maison_traveau;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Maison_traveauController extends Controller
{

    public function insert()
    {
        $maison_traveau = new Maison_traveau();
        $maison_traveaus = $maison_traveau::paginate(5);
        $id_traveau=Id_traveau::all()
        return view('maison_traveau.maison_traveau', [
            'maison_traveaus' => $maison_traveaus,
            'id_traveaus' => $id_traveau,
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'designation' => 'required',
'id_traveau' => 'required',

        ]);

        $maison_traveau = new Maison_traveau();
        $maison_traveau->insert($data);

        return redirect()->route('maison_traveau.ressource')->with('success', 'maison_traveau créé avec succès!');
    }

    public function modifier(Request $request)
    {
        $id = $request->input('idmaison_traveau');// afaka asina an'io ao arinan'ny idmaison_traveau
        $data = $request->validate([
            'designationmodal' => 'required',
'id_traveaumodal' => 'required',

        ]);
        $maison_traveau = new Maison_traveau();
        $maison_traveau->modifier($id, $data);

        return redirect()->route('maison_traveau.ressource')->with('success', 'maison_traveau modifié avec succès!');
    }
    public function destroy($id)
    {
        try {
            DB::table('maison_traveau')
                ->where('id', $id)// afaka asina an'io ao arinan'ny idmaison_traveau
                ->delete();

            return redirect()->route('maison_traveau.ressource')->with('success', 'maison_traveau supprimé avec succès!');
        } catch (\Exception $e) {
            // Gestion de l'erreur ici
            return redirect()->route('maison_traveau.ressource')->with('error', 'Une erreur est survenue lors de la suppression du maison_traveau.');
        }
    }


}
