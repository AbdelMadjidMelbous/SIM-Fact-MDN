<?php

namespace SimFactMdn\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SimFactMdn\Http\Controllers\Controller;
use SimFactMdn\Models\Marche;
use SimFactMdn\Models\Bc;
use SimFactMdn\Models\Bl;
use SimFactMdn\Models\Facture;
use SimFactMdn\Models\Cheque;
use SimFactMdn\Models\Produit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $marches = Marche::all();
        $marches_total = Marche::all()->count();
        $bcs_total = Bc::all()->count();
        $bls_total = Bl::all()->count();
        $factures_total = Facture::all()->count();
        $cheques_total = Cheque::all()->count();
        $produits_total = Produit::all()->count();
        $params = [
            'title' => 'Listes des Contrats',
            'marches' => $marches,
            'marches_total' => $marches_total,
            'bcs_total' => $bcs_total,
            'bls_total' => $bls_total,
            'factures_total' => $factures_total,
            'cheques_total' => $cheques_total,
            'produits_total' => $produits_total,
            ];
        return view('admin.dashboard')->with($params);
    }
    public function create()
    {
        return view('admin.contrats.contrats_create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'num_marche' => 'required|unique:marches',
            'date_marche' => 'required',
        ],
        [
            'num_marche.required' => 'Il faut introduire le numéro de contrat',
            'num_marche.unique' => 'Ce N° existe déja - Le numéro de contrat doit être unique -',
            'date_marche.required' => 'Il faut introduire la date du contrat',
        ]
        );
        
        $contrat = Marche::create([
            'num_marche' => $request->input('num_marche'),
            'date_marche' => Carbon::createFromFormat('d/m/Y', $request->input('date_marche')),
        ]);

            
        return redirect()->route('dashboard.index')->with('success', "Le Contrat N° <strong>$contrat->num_marche</strong> a été bien ajouté.");
    }

    public function show($id)
    {
        $contrat = Marche::findOrFail($id);
        $bcs = Bc::where('marche_id', $id)->get();
        $params = [
            'title' => 'Détail du Contrat',
            'contrat' => $contrat,
            'bcs' => $bcs,
            ];
        
        return view('admin.contrats.contrats_detail')->with($params);
    }
    public function destroy($id)
    {
    }
}
