@extends('template')

@section('contenu')
	<br />
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading">
				Quand et où aura lieu la prochaine manifestation :
			</div>
			<div class="panel-body">
				<form method="POST" action="{{ url('manif') }}" accept-charset="UTF-8">
					@csrf
					<div
						class="form-group {!! $errors->has('debut') ? 'has-error' : '' !!}"
					>
						<label for="lbDebut">Date du d&eacute;but</label>
						<input
							class="form-control"
							name="debut"
							type="date"
							value="{{ old('debut') }}"
						/>
						{!! $errors->first('debut', '<small class="help-block">:message</small>') !!}
					</div>
					<div
						class="form-group {!! $errors->has('fin') ? 'has-error' : '' !!}"
					>
						<label for="lbFin">Date de fin</label>
						<input
							class="form-control"
							name="fin"
							type="date"
							value="{{ old('fin') }}"
						/>
						{!! $errors->first('fin', '<small class="help-block">:message</small>') !!}
					</div>
					<div
						class="form-group {!! $errors->has('lieu') ? 'has-error' : '' !!}"
					>
						<label for="lbLieu">Lieu</label>
						<input
							class="form-control"
							name="lieu"
							type="text"
							value="{{ old('lieu') }}"
						/>
						{!! $errors->first('lieu', '<small class="help-block">:message</small>') !!}
					</div>
					<input
						class="btn btn-info pull-right"
						type="submit"
						value="Envoyer !"
					/>
				</form>
			</div>
		</div>
	</div>
@endsection
