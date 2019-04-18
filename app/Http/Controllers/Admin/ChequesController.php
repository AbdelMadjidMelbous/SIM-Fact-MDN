<?php

namespace SimFactMdn\Http\Controllers\Admin;

use Illuminate\Http\Request;
use SimFactMdn\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use SimFactMdn\Models\Bc;
use SimFactMdn\Models\Bl;
use SimFactMdn\Models\Facture;
use SimFactMdn\Models\Cheque;
use SimFactMdn\Models\Fact_Detail;
use SimFactMdn\Models\Region;
use SimFactMdn\Models\Bc_detail;
use SimFactMdn\Models\Bl_Detail;
use SimFactMdn\Models\Type_Produit;
use SimFactMdn\Models\Produit;
use SimFactMdn\Models\Lieu_Livr;
use SimFactMdn\Models\Marche;
use Carbon\Carbon;

class ChequesController extends Controller
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
        $cheques = Cheque::all();
        $params = [
        'title' => 'Listes des Cheques',
        'cheques' => $cheques,
        ];

        return view('admin.cheques.cheques_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $factures = Facture::where('cheque_id', null)->with('bl.bc', 'bl_details', 'lieu_livr.region')->get();
        
        $params = [
        'title' => 'Créer Cheque',
        'factures' => $factures,
        ];

        return view('admin.cheques.cheques_create')->with($params);
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
            'num_cheque' => 'required|unique:cheques',
            'date_cheque' => 'required',
            'montant' => 'required',
        ],
        [
            'num_cheque.required' => 'Il faut introduire le numéro de chèque',
            'num_cheque.unique' => 'Ce N° existe déja - Le numéro de chèque doit être unique -',
            'date_cheque.required' => 'Il faut introduire la date du chèque',
            'montant.required' => 'Il faut introduire le montant du chèque',
        ]
        );
        
        $cheque = Cheque::create([
            'num_cheque' => $request->input('num_cheque'),
            'date_cheque' => Carbon::createFromFormat('d/m/Y', $request->input('date_cheque')),
            'montant' => $request->input('montant'),
        ]);

        $factures_concernés = Input::get('fact_id');

        for ($i = 0; $i < count($factures_concernés); $i++) {
            Facture::where('id', $factures_concernés[$i])->update(array('cheque_id' => $cheque->id));
        }
            
        return redirect()->route('cheques.index')->with('success', "Le Chèque N° <strong>$cheque->num_cheque</strong> a été bien ajouté.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cheque = Cheque::findOrFail($id);
        $factures = Facture::where('cheque_id', $id)->with('bl.bc', 'bl_details', 'lieu_livr.region')->get();
        
        $params = [
        'title' => 'Detail du Chèque',
        'cheque' => $cheque,
        'factures' => $factures,
        ];
        return view('admin.cheques.cheques_detail')->with($params);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cheque = Cheque::find($id);
        $factures = Facture::where('cheque_id', $id)->get();
        foreach ($factures as $facture) {
            $facture->cheque_id = null;
            $facture->save();
        }
        $cheque->forcedelete();

        return redirect()->route('cheques.index')->with('success', "Le Chèque N° <strong>$cheque->num_cheque</strong> a éte bien supprimé.");
    }
}
