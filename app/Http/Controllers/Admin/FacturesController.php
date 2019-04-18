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

class FacturesController extends Controller
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
        $factures = Facture::with('bl.bc', 'bl_details', 'cheque', 'lieu_livr.region')->get();
        $params = [
        'title' => 'Listes des Factures',
        'factures' => $factures,
        ];

        return view('admin.factures.factures_list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $facture = Facture::findOrFail($id);
        $bl_details = Bl_Detail::where('fact_id', $id)->with('produit')->get();
        
        $params = [
        'title' => 'Detail de la Facture',
        'facture' => $facture,
        'bl_details' => $bl_details,
        ];
        return view('admin.factures.factures_detail')->with($params);
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
        //
    }
}
