@extends('template')

@section('header')
    @if(Auth::check())
    <div class="btn-group pull-right">
        <a href="{{route('voitures.create')}}" class="btn btn-info">Ajouter une voiture</a>
        <a href="{{url('logout')}}" class="btn btn-warning">Déconnexion</a>
    </div>
    <br><br>
    <div class="pull-right">Connecté en tant que {{Auth::user()->name}}</div>
    @else 
    <a href="{{url('login')}}" class="btn btn-info pull-right">Se connecter</a>
    @endif
@endsection

@section('contenu')
@if(session()->has('ok'))
    <div class="alert alert-success alert-dismissible">
        {!! session('ok') !!}
    </div>
@endif
{!!$links!!}
@foreach($voitures as $voiture)
<article class="row bg-primary">
    <div class="col-md-12">
        <header>
            <h1>{{$voiture->marque}} {{$voiture->type}} {{$voiture->couleur}} {{$voiture->cylindree}}l.</h1>
        </header>
        <hr>
        <section>
            <p>appartient à {{$voiture->user->name}}</p>
            @if ((Auth::check() && Auth::user()->admin) || (Auth::check() && Auth::user()->name == $voiture->user->name))
            <form method="POST" action="{{route('voitures.destroy', [$voiture->id])}}" accept-charset="UTF-8">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger btn-xs" onclick="return confirm('Vraiment supprimer cette voiture ?')" type="submit" value="Supprimer cette voiture">
            </form>
            @endif
        </section>
    </div>
</article>
<br>
@endforeach
{!! $links !!}
@endsection