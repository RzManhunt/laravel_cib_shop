@extends('layout.app')

@section('nav-bg', 'bg-dark')

@section('nav-links')
@endsection

@section('content')
<main class="row d-flex justify-content-center">
	<div class="col-md-8 d-flex flex-column align-items-start pt-4 px-0">
		<h2 class="font-weight-bold">
			<div class="title-decorator mb-1"></div>
				Pedido
			<div class="title-decorator mt-1"></div>
		</h2>
		<section class="w-100 d-flex pb-5 mb-5">
			<form class="col-md-6">
				<h5 class="font-weight-bold pt-2">Tus Datos</h5>
				<div class="form-group">
					<label for="email">Correo electronico</label>
					<input type="email" name="email" id="email" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="name">Nombre</label>
					<input type="text" name="name" id="name" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="address">Direccion</label>
					<input type="text" name="address" id="address" class="form-control"/>
				</div>

				<div class="form-group">
					<label for="city">Ciudad</label>
					<input type="text" name="city" id="city" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="province">Provincia / Estado</label>
					<input type="text" name="province" id="province" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="postal">Codigo Postal</label>
					<input type="text" name="postal" id="postal" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="phone">Telefono</label>
					<input type="text" name="phone" id="phone" class="form-control"/>
				</div>

				<h5 class="font-weight-bold pt-2">Detalles del Pago</h5>
				<div class="form-group">
					<label for="card-name">Nombre en la Tarjeta</label>
					<input type="text" name="card-name" id="card-name" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="car-address">Address</label>
					<input type="text" name="car-address" id="car-address" class="form-control"/>
				</div>
				<div class="form-group">
					<input type="submit" value="Enviar Pedido" class="w-100 btn btn-primary btn-lg" />
				</div>
			</form>
			<div class="col-md-6">
				<form>
					<h5 class="font-weight-bold pt-2">Tu Pedido</h5>
					<div class="d-flex flex-column">
						@foreach(\Cart::content() as $item)
						<article class="d-flex align-items-center justify-content-between articulo-pedido py-2">
							<img class="imagen-pedido" src="{{ $item->presentProductImage() }}" alt="{{ $item->name }}"/>
							<div class="px-2">
								<div class="font-weight-bold">{{ $item->name }}</div>
								<div>{{ $item->options()->details }}</div>
								<div>{{ $item->presentPrice() }}</div>
							</div>
							<input type="text" name="qty" value="{{ $item->qty }}" class="cantidad-pedido">
						</article>
						@endforeach
					</div>
					<div class="total-pedido pt-3 pb-2">
						<div class="d-flex justify-content-between pb-1">
							<span>Subtotal</span>
							<span>${{ \Cart::subtotal(2, ',', '.') }}</span>
						</div>
						<div class="d-flex justify-content-between pb-2">
							<span>Impuesto</span>
							<span>${{ \Cart::tax(2, ',', '.') }}</span>
						</div>
						<div class="d-flex justify-content-between">
							<h5 class="font-weight-bold">Total</h5>
							<h5 class="font-weight-bold">${{ \Cart::total(2, ',', '.') }}</h5>
						</div>
					</div>
				</form>
				<div></div>
			</div>
		</section>
	</div>
</main>
@endsection