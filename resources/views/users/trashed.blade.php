@extends('users.layout')
	@section('content')
	@if ($message = Session::get('success'))
		<div class="alert alert-success">
			<span>{{ $message }}</span>
		</div>
	@endif
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Usuários</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nome</th>
							<th>Email</th>
							<th>Telefone</th>
							<th>Excluído em</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Nome</th>
							<th>Email</th>
							<th>Telefone</th>
							<th>Excluído em</th>
						</tr>
					</tfoot>
					<tbody>
						@foreach ($users as $user)
							<tr>
								<td>{{ $user->id }}</td>
								<td>{{ $user->name }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone }}</td>
								<td>{{ \Carbon\Carbon::parse($user->deleted_at)->format('d/m/Y')}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection