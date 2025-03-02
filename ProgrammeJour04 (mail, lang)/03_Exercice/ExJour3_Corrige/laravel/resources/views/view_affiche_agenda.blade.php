@extends('template')

@section('titre')
Agenda (Exercice Jour 3)
@endsection

@section('contenu')
<br>
<div class="col-sm-offset-3 col-sm-6">
    <div class="panel panel-info">
        <div class="panel-heading"> Agenda des rdv : </div><br>
        <div class="panel-body">
            <table width=80%>
                <th width=65%>Personnes</th>
                <th width=15%>Debut</th>
                <th width=5%></th>
                <th width=15%>Fin</th>
                @for ($i = 0; $i < count($personnes); $i++)
                <tr>
                    <td>{{$personnes[$i]}}</td>
                    <td>{{$plagesDebut[$i]}}</td>
                    <td>-</td>
                    <td>{{$plagesFin[$i]}}</td>
                </tr>
                @endfor
            </table>
        </div>
    </div>
</div>
@endsection