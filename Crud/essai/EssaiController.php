<?php

namespace App\Http\Controllers;

use App\Models\Essai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EssaiController extends Controller
{

    public function insert()
    {
        $essai = new Essai();
        $essais = $essai::all();
        
        return view('essai.insert', [
            'essais' => $essais,
            
        ]);
    }

    public function create(Request $request)
    {
        $data = $request->validate([
            'designation' => 'required',

        ]);

        $essai = new Essai();
        $essai->insert($data);

        return redirect()->route('essai.ressource')->with('success', 'essai créé avec succès!');
    }

    public function modifier(Request $request)
    {
        $id = $request->input('idessai');
        $data = $request->validate([
            'designationmodal' => 'required',

        ]);
        $essai = new Essai();
        $essai->modifier($id, $data);

        return redirect()->route('essai.ressource')->with('success', 'essai modifié avec succès!');
    }
    public function destroy($id)
    {
        try {
            DB::table('essai')
                ->where('idessai', $id)
                ->delete();

            return redirect()->route('essai.ressource')->with('success', 'essai supprimé avec succès!');
        } catch (\Exception $e) {
            // Gestion de l'erreur ici
            return redirect()->route('essai.ressource')->with('error', 'Une erreur est survenue lors de la suppression du essai.');
        }
    }


}
