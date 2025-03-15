@extends('template')

@section('contenu')
	<br />
	<div class="col-sm-offset-3 col-sm-6">
		@if (session()->has('ok'))
			<div class="alert alert-success alert-dismissible">
				{!! session('ok') !!}
			</div>
		@endif

		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des voitures</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Marque</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($voitures as $voiture)
						<tr>
							<td>{!! $voiture->id !!}</td>
							<td class="text-primary">
								<strong>{!! $voiture->marque !!}</strong>
							</td>
							<td>
								<a
									href="{{ route('voiture.show', [$voiture->id]) }}"
									class="btn btn-success btn-block"
								>
									Voir
								</a>
							</td>
							<td>
								<a
									href="{{ route('voiture.edit', [$voiture->id]) }}"
									class="btn btn-warning btn-block"
								>
									Modifier
								</a>
							</td>
							<td>
								<form
									method="POST"
									action="{{ route('voiture.destroy', [$voiture->id]) }}"
								>
									@csrf
									@method('DELETE')
									<input
										type="submit"
										value="Supprimer"
										class="btn btn-danger btn-block"
										onclick="return confirm('Vraiment supprimer cette voiture ?')"
									/>
								</form>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<a href="{{ route('voiture.create') }}" class="btn btn-info pull-right">
			Ajouter une voiture
		</a>
		{!! $links !!}
	</div>
@endsection
