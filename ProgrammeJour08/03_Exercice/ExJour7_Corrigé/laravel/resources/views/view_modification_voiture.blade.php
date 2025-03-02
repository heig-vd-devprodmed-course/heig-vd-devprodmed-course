@extends('template')

@section('contenu')
<div class="col-sm-offset-4 col-sm-4">
    <br>
    <div class="panel panel-primary">
        <div class="panel-heading">Ajout d'une voiture</div>
        <div class="panel-body">
            <div class="col-sm-12">
                <form method="POST" action="{{route('voitures.update', [$voiture->id])}}" accept-charset="UTF-8" class="form-horizontalpanel">
                    @csrf
                    @method('PUT')
                    <div class="form-group {!! $errors->has('marque') ? 'has-error' : '' !!}">
                        Marque: <input type="text" name="marque" value="{{$voiture->marque}}" class="form-control">  
                        {!! $errors->first('marque', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}">
                        Type: <input type="text" name="type" value="{{$voiture->type}}" class="form-control">  
                        {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group {!! $errors->has('couleur') ? 'has-error' : '' !!}">
                        Couleur : <input name="couleur" type="text" value="{{$voiture->couleur}}" class="form-control">
                        {!! $errors->first('couleur', '<small class="help-block">:message</small>') !!}
                    </div>
                    <div class="form-group">
                        Cylindrée (litre)<input name="cylindree" type="text" value="{{$voiture->cylindree}}" class="form-control">
                        {!! $errors->first('cylindree', '<small class="help-block">:message</small>') !!}
                    </div>
                    <input class="btn btn-primary pull-right" type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </div>
    <a href="javascript:history.back()" class="btn btn-primary">
        <span class="glyphicon glyphicon-circle-arrow-left"></span>Retour
    </a>
</div>
@endsection