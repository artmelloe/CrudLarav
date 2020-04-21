@extends('users.layout')
@section('content')
	@if ($errors->any())
		<div class="alert alert-danger">
			Opa! Tem algum problema com os campos!<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	@if ($message = Session::get('error'))
		<div class="alert alert-danger">
			<span>{{ $message }}</span>
		</div>
	@endif
	<div class="row justify-content-center">
		<div class="col-xl-12 col-lg-12 col-md-12">
			<div class="card o-hidden border-0 shadow-lg my-5" style="margin: 0 !important;">
				<div class="card-body p-0">
					<div class="row">
						<div class="col-lg-12">
							<div class="p-5">
								<div class="text-center">
									<h1 class="h4 text-gray-900 mb-4">Editar usuário</h1>
								</div>
								<form class="user" action="{{ route('users.update',$user->id) }}" method="POST">
									@csrf
									@method('PUT')
									<div class="form-group">
										<input type="text" class="form-control form-control-user" name="name" value="{{ $user->name }}" placeholder="Nome">
									</div>
									<div class="form-group">
										<input type="email" class="form-control form-control-user" name="email" value="{{ $user->email }}" placeholder="Email">
									</div>
									<div class="form-group">
										<input type="text" class="form-control form-control-user" name="phone" id="phone" value="{{ $user->phone }}" placeholder="Telefone">
									</div>
									<div class="form-group text-center">
										<button type="submit" class="btn btn-primary btn-user" style="min-width: 100px;">
											Editar
										</button>
										<a href="{{ route('users.index') }}" class="btn btn-danger btn-user" style="min-width: 100px;">
											Voltar
										</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection