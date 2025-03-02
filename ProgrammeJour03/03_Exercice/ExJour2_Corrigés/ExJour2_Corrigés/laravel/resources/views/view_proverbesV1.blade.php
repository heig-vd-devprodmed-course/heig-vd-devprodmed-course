@extends('template')

@section('titre')
    Dix Proverbes
@endsection

@section('contenu')
  <table>
    <th>Liste des proverbes</th>
    @foreach($proverbes as $proverbe)
    <tr>
        <td> {{$proverbe}} </td>
    </tr>
    @endforeach
  </table>
@endsection