<?php

namespace SimFactMdn\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use SimFactMdn\Http\Controllers\Controller;
use SimFactMdn\Models\Bc;
use SimFactMdn\Models\Bl;
use SimFactMdn\Models\Facture;
use SimFactMdn\Models\Fact_Detail;
use SimFactMdn\Models\Region;
use SimFactMdn\Models\Bc_detail;
use SimFactMdn\Models\Bl_Detail;
use SimFactMdn\Models\Type_Produit;
use SimFactMdn\Models\Produit;
use SimFactMdn\Models\Lieu_Livr;
use SimFactMdn\Models\Marche;
use Carbon\Carbon;

class BlsController extends Controller
{
    
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
        $bls = Bl::with('lieu_livr', 'bc', 'lieu_livr.region')->get();
        $params = [
        'title' => 'Listes des BL',
        'bls' => $bls,
        ];

        return view('admin.bls.bls_list')->with($params);
    }

    public function detail($id)
    {
        $bl = Bl::findOrFail($id);
        $bl_details = Bl_Detail::where('bl_id', $id)->with('produit')->get();
        $params = [
        'title' => 'Detail du Bon',
        'bl' => $bl,
        'bl_details' => $bl_details,
        ];
        return view('admin.bls.bls_detail')->with($params);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marches = Marche::all();
        $bcs = Bc::all();
        $regions = Region::all();
        $lieu_livrs = Lieu_Livr::all();
        $params = [
        'title' => 'Créer BL',
        'marches' => $marches,
        'bcs' => $bcs,
        'regions' => $regions,
        'lieu_livrs' => $lieu_livrs,
        ];

        return view('admin.bls.bls_create')->with($params);
    }

    public function getLieux(Request $request)
    {
        $lieu_ids = Bc_detail::where('bc_id', $request->bc_id)->pluck('lieu_livr_id');
        $lieu_livrs = Lieu_Livr::where('region_id', $request->region_id)->whereIn('id', $lieu_ids)->get();
        return response ()->json ($lieu_livrs);
    }

    public function getBcdetails(Request $request)
    {
        $query = ['bc_id' => $request->bc_id,'lieu_livr_id' => $request->lieu_livr_id];
        $bc_details = Bc_detail::where($query)->get();
        return response ()->json ($bc_details);
    }

    public function getBcs(Request $request)
    {
        $bcs = Bc::where('marche_id', $request->marche_id)->get();
        return response ()->json ($bcs);
    }

    public function createDetails($id)
    {
        $bl = Bl::findOrFail($id);
        $query = ['bc_id' => $bl->bc_id,'lieu_livr_id' => $bl->lieu_livr_id];
        $bc_details = Bc_detail::where($query)->with('produit')->get();
        $params = [
        'bl' => $bl,
        'bc_details' => $bc_details,
        ];
        return view('admin.bls.bls_createDetails')->with($params);
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
        'bc_id' => 'required',
        'num_bl' => 'required|unique:bls',
        'num_fact' => 'required|unique:factures',
        'region_id' => 'required',
        'lieu_livr_id' => 'required',
        'date_bl' => 'required',
        ],
        [
        'bc_id.required' => 'Il faut introduire le N° du BC',
        'num_bl.required' => 'Il faut introduire le N° du BL',
        'num_bl.unique' => 'Ce N° existe déja - Le N° BL doit être unique -',
        'num_fact.required' => 'Il faut introduire le N° du Facture associé',
        'num_fact.unique' => 'Ce N° existe déja - Le N° Facture doit être unique -',
        'region_id.required' => 'Il faut introduire la region',
        'lieu_livr_id.required' => 'Il faut choisir le lieu',
        'date_bl.required' => 'Il faut introduire la date du BL',
        ]
        );

        $fact = Facture::create([
            'num_fact' => $request->input('num_fact'),
            'num_bl' => $request->input('num_bl'),
            'date_fact' => Carbon::createFromFormat('d/m/Y', $request->input('date_bl')),
            'lieu_livr_id' => $request->input('lieu_livr_id'),
        ]);

        $bl = Bl::create([
        'bc_id' => $request->input('bc_id'),
        'fact_id' => $fact->id,
        'num_bl' => $request->input('num_bl'),
        'lieu_livr_id' => $request->input('lieu_livr_id'),
        'date_bl' => Carbon::createFromFormat('d/m/Y', $request->input('date_bl')),
        ]);
        
        $bl_id = $bl->id;
      
        return redirect()->route('bls.createDetails', ['id' => $bl_id]);
    }

    public function storeDetails(Request $request)
    {
        $quantities = Input::get('quantite_livr');
        $produits = Input::get('produit_id');
        $bc_details = Input::get('bc_detail_id');
        $bl_id = Input::get('bl_id');
        $bl = Bl::findOrFail($bl_id);
        
        for ($i = 0; $i < count($quantities); $i++) {
            if ($quantities[$i] <> '') {
                    $bl_detail = new Bl_Detail;
                    $bl_detail->bl_id = $bl_id ;
                    $bl_detail->num_bl = $bl->num_bl;
                    $bl_detail->fact_id = $bl->fact_id;
                    $bl_detail->bc_detail_id = $bc_details[$i];
                    $bl_detail->produit_id = $produits[$i];
                    $bl_detail->quantite_livr = $quantities[$i];
                    $bl_detail->save ();

                    $bc_detail_id = $bl_detail->bc_detail_id;
                    $quantity = $bl_detail->quantite_livr;
                    $this->CalculQuantities($bc_detail_id, $quantity);
            }
        }

        $facture = Facture::findOrFail($bl->fact_id);
        $bl_details = Bl_Detail::where('fact_id', $bl->fact_id)->with('produit')->get();
        $total = 0;
        $taux_tva = 0;
        $total_ligne = 0;
        
        foreach ($bl_details as $row) {
            $total_ligne = (($row->quantite_livr)*1000)* ($row->produit->prix_unit_ht);
            $total += $total_ligne;
            $taux_tva += $total_ligne * ($row->produit->tva->designation)/100;
        }

        $facture->montant_tva = $taux_tva;
        $facture->total_ht = $total;
        $facture->total_ttc = $total + $taux_tva;
        $facture->save();

        return redirect()->route('bls.index')->with('success', "Le bon a été bien ajouté.");
    }

    public function CalculQuantities($bc_detail_id, $quantity)
    {
        $bc_detail = Bc_detail::find($bc_detail_id);
        $bc_detail->quantite_livr += $quantity;
        $bc_detail->quantite_rest -= $quantity;
        $bc_detail->save();
    }
    public function CalculQuantitiesDelete($bc_detail_id, $quantity)
    {
        $bc_detail = Bc_detail::find($bc_detail_id);
        $bc_detail->quantite_livr -= $quantity;
        $bc_detail->quantite_rest += $quantity;
        $bc_detail->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $bl_detail = Bl_Detail::find($id);
        $old_quantity = $bl_detail->quantite_livr;
        $bl_detail->quantite_livr = $request->input('quantite_livr');
        $bl_detail->save();

        $bc_detail_id = $bl_detail->bc_detail_id;
        $quantity = $bl_detail->quantite_livr - $old_quantity;
        $this->CalculQuantities($bc_detail_id, $quantity);
        
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bl = Bl::find($id);
        $fact = Facture::find($bl->fact_id);
        $bl_details = Bl_Detail::where('bl_id', $id)->get();
        foreach ($bl_details as $bl_detail) {
            $bl_detail->delete();
            $bc_detail_id = $bl_detail->bc_detail_id;
            $quantity = $bl_detail->quantite_livr;
            $this->CalculQuantitiesDelete($bc_detail_id, $quantity);
        }
        $bl->delete();
        $fact->delete();

        return redirect()->route('bls.index')->with('success', "Le Bon N° <strong>$bl->num_bl</strong> a éte bien supprimé.");
    }

    public function destroyDetail($id)
    {
        $bl_detail = Bl_Detail::find($id);
        $bc_detail_id = $bl_detail->bc_detail_id;
        $quantity = $bl_detail->quantite_livr;
        $this->CalculQuantitiesDelete($bc_detail_id, $quantity);
        $bl_detail->delete();

        return redirect()->back();
    }
}
