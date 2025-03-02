@extends('template')

@section('titre')
    Dix Proverbes
@endsection

@section('contenu')
  <table>
    <th>{{$source}}</th>
    @foreach($proverbes as $proverbe)
    <tr>
        <td> {{$proverbe}} </td>
    </tr>
    @endforeach
  </table>
@endsection