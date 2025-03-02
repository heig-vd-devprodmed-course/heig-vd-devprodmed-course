@extends('template')

@section('titre')
Artistes
@endsection

@section('contenu')
<table>
    @foreach($artistes as $artiste)
    <tr><td> {{$artiste['nom']}} </td>
        <td> {{$artiste['prenom']}} </td>
        <td> {{$artiste["dateNaissance"]->format("d-m-Y")}} </td>
    </tr>
    @endforeach
</table>
@endsection