<?php

namespace App\Http\Controllers;

use App\Models\Maison;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaisonController extends Controller
{

    public function insert()
    {
        $maison = new Maison();
        $maisons = $maison::paginate(5);
        
        return view('maison.maison', [
            'maisons' => $maisons,
            
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'designation' => 'required',
'description' => 'required',
'surface' => 'required',
'duree' => 'required',

        ]);

        $maison = new Maison();
        $maison->insert($data);

        return redirect()->route('maison.ressource')->with('success', 'maison créé avec succès!');
    }

    public function modifier(Request $request)
    {
        $id = $request->input('idmaison');// afaka asina an'io ao arinan'ny idmaison
        $data = $request->validate([
            'designationmodal' => 'required',
'descriptionmodal' => 'required',
'surfacemodal' => 'required',
'dureemodal' => 'required',

        ]);
        $maison = new Maison();
        $maison->modifier($id, $data);

        return redirect()->route('maison.ressource')->with('success', 'maison modifié avec succès!');
    }
    public function destroy($id)
    {
        try {
            DB::table('maison')
                ->where('id', $id)// afaka asina an'io ao arinan'ny idmaison
                ->delete();

            return redirect()->route('maison.ressource')->with('success', 'maison supprimé avec succès!');
        } catch (\Exception $e) {
            // Gestion de l'erreur ici
            return redirect()->route('maison.ressource')->with('error', 'Une erreur est survenue lors de la suppression du maison.');
        }
    }


}
