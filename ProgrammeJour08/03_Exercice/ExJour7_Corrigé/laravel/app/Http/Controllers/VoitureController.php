<?php

namespace App\Http\Controllers;

use App\Http\Requests\VoitureRequest;
use App\Models\Voiture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class VoitureController extends Controller implements HasMiddleware
{
    
    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['index']),
            new Middleware('admin', only: ['destroy']),
        ];
    }
	
	private $nbParPage = 4;
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $voitures=Voiture::with('user')
                ->orderBy('voitures.marque','asc')
                ->orderBy('voitures.type','asc')
                ->orderBy('voitures.couleur','asc')
                ->orderBy('voitures.cylindree','desc')
                ->paginate($this->nbParPage);   
        $links=$voitures->render();    // permet de créer une "barre de navigation"
        return view('view_liste_voitures', compact('voitures','links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('view_creation_voiture');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VoitureRequest $request)
    {
        if (isset($request->user_id)) {
            $inputs=array_merge($request->all());
        } else {
            $inputs=array_merge($request->all(), ['user_id'=>Auth::user()->id]);
        }
        Voiture::create($inputs);
        return redirect('voitures')->withOk("La voiture a été ajoutée.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voiture = Voiture::findOrFail($id);
        return view('view_detail_voiture', compact('voiture'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $voiture=Voiture::findOrFail($id);
        return view('view_modification_voiture', compact('voiture'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VoitureRequest $request, $id)
    {
        Voiture::findOrFail($id)->update($request->all());
        return redirect('voitures')->withOk("La voiture a été modifiée");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Voiture::findOrFail($id)->delete();
        return redirect()->back();
    }
}