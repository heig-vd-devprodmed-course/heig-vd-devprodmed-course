@extends('template')

@section('contenu')
	<br />
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-info">
			<div>Veuillez choisir les personnes concernées par les entrevues :</div>
			<form method="POST" action="{{ url('agenda') }}" accept-charset="UTF-8">
				@csrf
				@foreach ($personnes as $personne)
					<input name="personnes[]" type="checkbox" value="{{ $personne }}" />
					{{ $personne }}
					<br />
				@endforeach

				<div>
					<label for="heureDebut">Entrez une heure de d&eacute;but :</label>
					<input name="heureDebut" type="time" id="heureDebut" />
				</div>
				<div>
					<label for="heureFin">Entrez une heure de fin :</label>
					<input name="heureFin" type="time" id="heureFin" />
				</div>
				<div>
					<label for="pause">Entrez un temps de pause :</label>
					<input name="dureePause" type="time" />
				</div>
				<div>
					<input type="submit" value="Envoyer" />
				</div>
			</form>
		</div>
	</div>
@endsection
