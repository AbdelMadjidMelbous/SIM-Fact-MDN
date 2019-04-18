<?php

namespace SimFactMdn\Http\Controllers\Admin;

use SimFactMdn\Models\Tva;
use SimFactMdn\Models\Unite_mesure;
use SimFactMdn\Models\Produit;
use Illuminate\Http\Request;
use SimFactMdn\Models\Type_Produit;
use SimFactMdn\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProduitsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     
    public function index()
    {
        $produits = Produit::all();
        
                $params = [
                    'title' => 'Liste Produits',
                    'produits' => $produits,
                ];
        
                return view('admin.produits.produits_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$types = Type_Produit::all();
        $u_mesures = Unite_mesure::all();
        $tvas = Tva::all();
        $params = [
            'title' => 'Créer Produit',
            //'types' => $types,
            'u_mesures' => $u_mesures,
            'tvas' => $tvas,
        ];

        return view('admin.produits.produits_create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'code_produit' => 'required|unique:produits',
            'des_produit' => 'required',
            'u_mesure' => 'required',
            'prix_unit_ht' => 'required',
            //'type_id' => 'required',
            'tva_id' => 'required',
        ],
        [
            'code_produit.required' => 'Il faut introduire le code du produit',
            'code_produit.unique' => 'Ce code existe déja - Le code du produit doit être unique -',
            'des_produit.required' => 'Il faut introduire la description du produit',
            'u_mesure.required' => 'Il faut choisir une unité de mesure',
            'prix_unit_ht.required' => 'Il faut introduire le prix du produit',
            //'type_id.required' => 'Il faut choisir le type du produit',
            'tva_id.required' => 'Il faut choisir le tva',
        ]
        );
        $tva = Tva::find($request->input('tva_id'));
        $prix_unit_ttc = $request->input('prix_unit_ht') + $request->input('prix_unit_ht') * $tva->designation /100;
        
        $produit = Produit::create([
            'code_produit' => $request->input('code_produit'),
            'des_produit' => $request->input('des_produit'),
            //'type_id' => $request->input('type_id'),
            'u_mesure' => $request->input('u_mesure'),
            'prix_unit_ht' => $request->input('prix_unit_ht'),
            'tva_id' => $request->input('tva_id'),
            'prix_unit_ttc' => $prix_unit_ttc,
        ]);
        
        return redirect()->route('produits.index')->with('success', "Le produit <strong>$produit->des_produit</strong> a été bien ajouté.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $produit = Produit::findOrFail($id);

            $params = [
                'title' => 'Supprimer Produit',
                'produit' => $produit,
            ];

            return $produit;
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            //$types = Type_Produit::all();
            $u_mesures = Unite_mesure::all();
            $tvas = Tva::all();
            $produit = Produit::findOrFail($id);
            $params = [
                'title' => 'Modifier Produit',
                //'types' => $types,
                'u_mesures' => $u_mesures,
                'tvas' => $tvas,
                'produit' => $produit,
            ];

            return view('admin.produits.produits_edit')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'code_produit' => 'required|unique:produits,code_produit,'.$id,
                'des_produit' => 'required',
                'u_mesure' => 'required',
                'prix_unit_ht' => 'required',
                //'type_id' => 'required',
                'tva_id' => 'required',
            ],
            [
                'code_produit.required' => 'Il faut introduire le code du produit',
                'code_produit.unique' => 'Ce code existe déja - Le code du produit doit être unique -',
                'des_produit.required' => 'Il faut introduire la description du produit',
                'u_mesure.required' => 'Il faut choisir une unité de mesure',
                'prix_unit_ht.required' => 'Il faut introduire le prix du produit',
                //'type_id.required' => 'Il faut choisir le type du produit',
                'tva_id.required' => 'Il faut choisir le tva',
            ]
            );
            $produit = Produit::findOrFail($id);
            $tva = Tva::find($request->input('tva_id'));
            $prix_unit_ttc = $request->input('prix_unit_ht') + $request->input('prix_unit_ht') * $tva->designation /100;
            $produit->code_produit = $request->input('code_produit');
            $produit->des_produit = $request->input('des_produit');
            //$produit->type_id = $request->input('type_id');
            $produit->u_mesure = $request->input('u_mesure');
            $produit->prix_unit_ht = $request->input('prix_unit_ht');
            $produit->tva_id = $request->input('tva_id');
            $produit->prix_unit_ttc = $prix_unit_ttc;
        
            $produit->save();

            return redirect()->route('produits.index')->with('success', "Le produit <strong>$produit->des_produit</strong> a été bien modifié.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Remove the specified resouraction('TodoController@create')ce from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $produit = Produit::find($id);

            $produit->delete();

            return redirect()->route('produits.index')->with('success', "Le produit <strong>$produit->des_produit</strong> a éte bien supprimé.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /*public function cre(Request ){

        $var = '';
       // $('#datatable tbody').append("tr "+jsond/tr")
        return json_encode(['etat'=>$var, 'id']);
    }*/
}
