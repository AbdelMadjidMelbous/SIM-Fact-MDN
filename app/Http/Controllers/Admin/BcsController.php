<?php

namespace SimFactMdn\Http\Controllers\Admin;

use SimFactMdn\Models\Bc;
use SimFactMdn\Models\Region;
use SimFactMdn\Models\Bc_detail;
use SimFactMdn\Models\Type_Produit;
use SimFactMdn\Models\Produit;
use SimFactMdn\Models\Lieu_Livr;
use SimFactMdn\Models\Marche;
use Illuminate\Http\Request;
use SimFactMdn\Http\Controllers\Controller;
use Carbon\Carbon;
use JsValidator;
use Response;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Proengsoft\JsValidation\Facades\JsValidatorFacade;

class BcsController extends Controller
{

    

    protected $validationRules=[
        'marche_id' => 'required',
        'num_bc' => 'required',
        'date_bc' => 'required',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bcs = Bc::all();
        $params = [
        'title' => 'Listes des BC',
        'bcs' => $bcs,
        ];

        return view('admin.bcs.bcs_list')->with($params);
    }

    public function detail($id)
    {
        try {
            $bc = Bc::findOrFail($id);
            $bc_details = Bc_detail::where('bc_id', $id)->with('produit', 'lieu_livr')->get();
            $regions = Region::all();
            $TotalComRegions = array();
            $TotalLivrRegions = array();
            $i=0;
            foreach ($regions as $region) {
                $TotalComRegions[$i] = 0;
                $TotalLivrRegions[$i] = 0;
                foreach ($bc_details as $bc_detail) {
                    if ($bc_detail->lieu_livr->region_id == $region->id) {
                        $TotalComRegions[$i] += $bc_detail->quantite_com;
                        $TotalLivrRegions[$i] += $bc_detail->quantite_livr;
                    }
                }
                $i++;
            }
            $produits = Produit::all();
            $marches = Marche::all();
            $params = [
            'title' => 'Detail du Bon',
            'bc' => $bc,
            'bc_details' => $bc_details,
            'regions' => $regions,
            'TotalComRegions' => $TotalComRegions,
            'TotalLivrRegions' => $TotalLivrRegions,
            'produits' => $produits,
            'marches' => $marches,
            ];
            return view('admin.bcs.bcs_detail')->with($params);
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }
    
    public function getLieux(Request $request)
    {
        $lieu_livrs = Lieu_Livr::where('region_id', $request->region_id)->get();
        return response ()->json ($lieu_livrs);
    }

    public function regionDetails($id, $bc_id)
    {
        $bc = Bc::findOrFail($bc_id);
        $produits = Produit::all();
        $region = Region::findOrFail($id);
        $lieu_livrs = Lieu_Livr::where('region_id', $id)->get();
        $bc_details = Bc_detail::where('bc_id', $bc_id)->with(['lieu_livr' => function ($q) use ($id) {
            $q->where('region_id', $id);
        }])->get();
        $TotalComLieux = array();
        $TotalLivrLieux = array();
        $i=0;
        foreach ($lieu_livrs as $lieu) {
            $TotalComLieux[$i] = 0;
            $TotalLivrLieux[$i] = 0;
            foreach ($bc_details as $bc_detail) {
                if ($bc_detail->lieu_livr_id == $lieu->id) {
                    $TotalComLieux[$i] += $bc_detail->quantite_com;
                    $TotalLivrLieux[$i] += $bc_detail->quantite_livr;
                }
            }
            $i++;
        }
        
        $params = [
        'bc' => $bc,
        'bc_details' => $bc_details,
        'region' => $region,
        'lieu_livrs' => $lieu_livrs,
        'TotalComLieux' => $TotalComLieux,
        'TotalLivrLieux' => $TotalLivrLieux,
        'produits' => $produits,
        ];
        return view('admin.bcs.bcs_regionDetails')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $marches = Marche::all();

        $params = [
        'title' => 'Créer BC',
        'marches' => $marches,
        ];

        return view('admin.bcs.bcs_create')->with($params);
    }
    public function createDetails($id)
    {
        $regions = Region::all();
        $lieu_livrs = Lieu_Livr::all();
        $produits = Produit::all();
        $bc = Bc::findOrFail($id);
        $num_bc = $bc->num_bc;
        $bc_id = $bc->id;
        $bc_details = Bc_detail::where('bc_id', $bc_id)->with('produit', 'lieu_livr')->get();
        $params = [
        'bc_id' => $bc_id,
        'num_bc' => $num_bc,
        'produits' => $produits,
        'regions' => $regions,
        'lieu_livrs' => $lieu_livrs,
        'bc_details' => $bc_details,
        ];
        return view('admin.bcs.bcs_createDetails')->with($params);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Bc::withTrashed()->where('num_bc', $request->input('num_bc'))->where('deleted_at', '<>', null)->get()) {
            $this->validate($request, [
                'marche_id' => 'required',
                'num_bc' => 'required',
                'date_bc' => 'required',
                ],
                [
                'marche_id.required' => 'Il faut introduire le marche',
                'num_bc.required' => 'Il faut introduire le N° de Bon de commande',
                'date_bc.required' => 'Il faut introduire la date de BC'
                ]
                );
            $bc = Bc::withTrashed()->UpdateOrCreate(['num_bc' => $request->input('num_bc')], [
                'marche_id' => $request->input('marche_id'),
                'date_bc' => Carbon::createFromFormat('d/m/Y', $request->input('date_bc')),
                'deleted_at' => null
            ]);
            $bc_id = $bc->id;
            
              return redirect()->route('bcs.createDetails', ['id' => $bc_id]);
        } else {
            $this->validate($request, [
            'marche_id' => 'required',
            'num_bc' => 'required|unique:bcs',
            'date_bc' => 'required',
            ],
            [
            'marche_id.required' => 'Il faut introduire le marche',
            'num_bc.required' => 'Il faut introduire le N° de Bon de commande',
            'num_bc.unique' => 'Ce N° existe déja - Le numéro de BC doit être unique -',
            'date_bc.required' => 'Il faut introduire la date de BC'
            ]
            );
        
        
            $bc = Bc::Create([
            'num_bc' => $request->input('num_bc'),
            'marche_id' => $request->input('marche_id'),
            'date_bc' => Carbon::createFromFormat('d/m/Y', $request->input('date_bc')),
            ]);
            $bc_id = $bc->id;
      
            return redirect()->route('bcs.createDetails', ['id' => $bc_id]);
        }
    }

    public function storeDetails(Request $request)
    {
        /*$this->validate($request, [
        'region_id' => 'required',
        'lieu_livr_id' => 'required',
        'produit_id' => 'required',
        'quantite_com' => 'required',
        ],
        [
        'region.required' => 'Il faut introduire la region ',
        'lieu_livr_id.required' => 'Il faut introduire le lieu de livraison',
        'produit_id.required' => 'Il faut introduire le produit'
        ]
        );*/
        $rules = [
        'region_id' => 'required',
        'lieu_livr_id' => 'required|unique:bc_details,lieu_livr_id,NULL,id,produit_id,'.$request->produit_id.',bc_id,'.$request->bc_id,
        'produit_id' => 'required',
        'quantite_com' => 'required',
        ];
        $messages = [
            'region_id.required' => 'Il faut choisir la region ',
            'lieu_livr_id.required' => 'Il faut choisir le lieu de livraison',
            'lieu_livr_id.unique' => 'Ce lieu contient deja  ce produit',
            'produit_id.required' => 'Il faut choisir le produit',
            'quantite_com.required' => 'Il faut introduire la quantite'
        ];
        $validator = Validator::make ( Input::all (), $rules, $messages );
        if ($validator->fails ()) {
            return Response::json ( array (
                    
            'errors' => $validator->getMessageBag ()->toArray ()
            ) );
        } else {
            $bc_detail = new Bc_detail;
            $bc_detail->bc_id = $request->bc_id;
            $bc_detail->num_bc = $request->num_bc;
            $bc_detail->lieu_livr_id = $request->lieu_livr_id;
            $bc_detail->produit_id = $request->produit_id;
            $bc_detail->quantite_com = $request->quantite_com;
            $bc_detail->quantite_rest = $request->quantite_com;
            $bc_detail->save ();

            return response ()->json ($bc_detail);
        }
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
        $this->validate($request, [
            'marche_id' => 'required',
            'num_bc' => 'required',
            'date_bc' => 'required',
            ],
            [
            'marche_id.required' => 'Il faut introduire le marche',
            'num_bc.required' => 'Il faut introduire le N° de Bon de commande',
            'date_bc.required' => 'Il faut introduire la date de BC'
            ]
            );
            
            $bc = Bc::findOrFail($id);
            $bc->marche_id = $request->input('marche_id');
            $bc->num_bc = $request->input('num_bc');
            $bc->date_bc = Carbon::createFromFormat('d/m/Y', $request->input('date_bc'));

            $bc->save();

            return redirect()->route('bcs.detail', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $bc = Bc::find($id);
            $bc_details = Bc_detail::where('bc_id', '=', $id)->get();
            $bc->delete();
            foreach ($bc_details as $bc_detail) {
                $bc_detail->delete();
            }

            return redirect()->route('bcs.index')->with('success', "Le Bon N° <strong>$bc->num_bc</strong> a éte bien supprimé.");
        } catch (ModelNotFoundException $ex) {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }
    public function destroyDetail($id)
    {
        $bc_detail = Bc_detail::find($id);
        
        $bc_detail->forcedelete();

        return redirect()->back();
    }
}
