@extends('template')

@section('titre')
Formulaire d'ajout d'une voiture'
@endsection

@section('contenu')
<div class="col-sm-offset-4 col-sm-4">
  <div class="panel panel-info">
    <div class="panel-heading">Ajout d'une voiture</div>
    <div class="panel-body">
      <form method="POST" action="{{ url('voiture') }}" accept-charset="UTF-8">
        @csrf
        <div class="form-group ">
            <label for="marque">Marque</label>
            <input class="form-control" placeholder="Marque" name="marque" type="text">
            {!! $errors->first('marque', '<small class="help-block">:message</small>') !!}
        </div>
        <div class="form-group ">
            <label for="type">Type</label>
            <select class="form-control" name="type" type="date">
              <option value="break">Break</option>
              <option value="cabriolet">Cabriolet</option>
              <option value="SUV">SUV</option>
              <option value="limousine">Limousine</option>
              <option value="pickup">Pickup</option>
            </select>
            {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
        </div>
        <div class="form-group ">
            <label for="couleur">Couleur</label>
            <input class="form-control" placeholder="Couleur" name="couleur" type="text"/>
            {!! $errors->first('couleur', '<small class="help-block">:message</small>') !!}
        </div>
        <div class="form-group ">
            <label for="cylindree">Cylindrée (litre)</label>
            <input class="form-control" placeholder="Cylindree en litres" name="cylindree" type="text"/>
            {!! $errors->first('cylindree', '<small class="help-block">:message</small>') !!}
        </div>
        <input class="btn btn-info pull-right" type="submit" value="Envoyer !">
      </form>
    </div>
  </div>
<div>
@endsection