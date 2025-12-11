@extends('template')

@section('contenu')
	<div class="col-sm-offset-3 col-sm-6">
		<br />
		<div class="panel panel-primary">
			<div class="panel-heading">Ajout d'une voiture</div>
			<div class="panel-body">
				<div class="col-sm-12">
					<form
						method="POST"
						action="{{ route('voiture.store') }}"
						accept-charset="UTF-8"
						class="form-horizontalpanel"
					>
						@csrf
						<div
							class="form-group {!! $errors->has('marque') ? 'has-error' : '' !!}"
						>
							Marque:
							<input type="text" name="marque" value="" class="form-control" />
							{!! $errors->first('marque', '<small class="help-block">:message</small>') !!}
						</div>
						<div
							class="form-group {!! $errors->has('type') ? 'has-error' : '' !!}"
						>
							Type:
							<input type="text" name="type" value="" class="form-control" />
							{!! $errors->first('type', '<small class="help-block">:message</small>') !!}
						</div>
						<div
							class="form-group {!! $errors->has('couleur') ? 'has-error' : '' !!}"
						>
							Couleur :
							<input name="couleur" type="text" value="" class="form-control" />
							{!! $errors->first('couleur', '<small class="help-block">:message</small>') !!}
						</div>
						<div class="form-group">
							Cylindrée (litre)
							<input
								name="cylindree"
								type="text"
								value=""
								class="form-control"
							/>
							{!! $errors->first('cylindree', '<small class="help-block">:message</small>') !!}
						</div>
						<input
							class="btn btn-primary pull-right"
							type="submit"
							value="Envoyer"
						/>
					</form>
				</div>
			</div>
		</div>
		<a href="javascript:history.back()" class="btn btn-primary">
			<span class="glyphicon glyphicon-circle-arrow-left"></span>
			Retour
		</a>
	</div>
@endsection
