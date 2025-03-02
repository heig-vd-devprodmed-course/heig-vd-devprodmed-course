<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voiture;
use App\Http\Requests\VoitureRequest;

class VoitureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voitures=Voiture::paginate(4);	// permet de voir quatre utilisateurs à la fois
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
        $voiture = Voiture::create($request->all());
        return redirect('voiture')->withOk("La " . $voiture->marque . " a été ajoutée.");
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
        return redirect('voiture')->withOk("La voiture a été modifiée");
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
