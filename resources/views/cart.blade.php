@extends('layout.app')

@section('nav-bg', 'bg-dark')

@section('content')
<nav class="bg-lightgray row d-flex justify-content-center py-2">
	<ul class="col-md-8 breadcrumb m-0">
		<li><a href="{{ url('/') }}">Home</a></li>
		<li>Carro</li>
	</ul> 
</nav>

<main class="row d-flex justify-content-center">
	<div class="col-md-8 d-flex flex-column align-items-start pt-4 px-0">
		@if(session()->has('success_message'))
			<div class="alert alert-success w-100">
				{{ session()->get('success_message') }}
			</div>
		@endif
		@if(count($errors) > 0)
			<div class="alert alert-danger w-100">
				<ul>
					@foreach($errors->all() as $error)
						<li>$error</li>
					@endforeach
				</ul>
			</div>
		@endif

		@if(\Cart::count() > 0)
		<h2 class="font-weight-bold">
			{{ \Cart::count() }}
			item(s) en el carro
		</h2>
		<div class="container-fluid">
		@foreach(\Cart::content() as $item)
		<article class="row articulo-pedido py-2">
			<img class="imagen-pedido pr-3 col-md-2" src="{{ $item->presentProductImage() }}" alt="{{ $item->name }}" />
			<div class="d-flex flex-column justify-content-center col-md-5 pr-5">
				<div class="font-weight-bold">{{ $item->name }}</div>
				<div>{{ $item->options()->details }}</div>
			</div>
			<div class="d-flex flex-column col-md-2 align-items-end justify-content-center pr-0">
				<div class="d-flex flex-column">
					<form action="{{ route('cart.remove') }}" method="POST">
						@csrf
						@method('DELETE')
						<input type="hidden" name="product_id" value="{{ $item->product_id }}" />
						<input class="font-weight-bold btn btn-sm btn-danger" type="submit" value="Remove" />
					</form>
				</div>
			</div>
			<div class="d-flex align-items-center col-md-3">
				<select class="quantity ml-2 mr-4" data-id="{{ $item->product_id }}">
					@for($i = 1; $i < 5 + 1; $i++)
						<option value="{{ $i }}"
						{{ $i == $item->qty ? 'selected' : '' }}>
							{{ $i }}
						</option>
					@endfor
				</select> 
				<div class="d-flex align-items-start">{{ $item->presentPrice() }}</div>
			</div>
		</article>
		@endforeach
		</div>
{{--		
		<section class="d-flex flex-column w-100">
			<p class="pt-5 pb-0 border-top-black font-weight-bold">
				Tienes un Cupon?
			</p>
			<form class="pb-3 pt-1 border-dark">
				<div class="form-group">
					<input class="mx-0 px-0" type="text" name="cupon">
					<input class="mx-0 px-0" type="submit" value="Enviar">
				</div>
			</form>
		</section>
--}}
		<div class="pt-5 container-fluid">
			<div class="row total-cart p-3 mb-5">
				<div class="pr-5 col-md-7 text-justify">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat.
				</div>
				<div class="col-md-5 pb-1 d-flex justify-content-end align-items-center">
					<div class="d-flex flex-column align-items-end">
						<span class="font-weight-bold">Subtotal</span>
						<span class="font-weight-bold pb-2">Impuesto</span>
						<h5 class="font-weight-bold">Total</h5>
					</div>
					<div class="d-flex flex-column align-items-end">
						<span class="font-weight-bold pl-3">${{ \Cart::subtotal(2, ',', '.') }}</span>						
						<span class="font-weight-bold pl-3 pb-2">${{ \Cart::tax(2, ',', '.') }}</span>
						<h5 class="font-weight-bold pl-3">${{ \Cart::total(2, ',', '.') }}</h5>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid d-flex justify-content-between px-5 pb-5">
			<a href="{{ route('shop.index') }}" class="btn btn-lg">
				Seguir Comprando
			</a>
			<form action="{{ route('checkout.index') }}" method="POST">
				@csrf
				<input type="submit" value="Realizar Pedido" class="btn btn-success btn-lg"/>
			</form>
		</div>

		@else
		<h2 class="font-weight-bold">
			El carro esta vacio
		</h2>
		@endif

		@include('includes.might-like')

	</div>
</main>
@endsection

@section('extra-js')

<script src="{{ asset('js/app.js') }}"></script>
<script>

(function(){
	const qtyLists = document.querySelectorAll('.quantity');

	Array.from(qtyLists).forEach(element => {
		element.addEventListener('change', function(){
			const product_id = this.getAttribute('data-id');
console.log(product_id)
			axios.patch('/carro/' + product_id, {
				quantity: this.value
			})
			.then(function(response){
				console.log(response)
				// document.location.href="{{ route('cart.index') }}"
			})
			.catch(function(error){
				console.log(error)
				// document.location.href="{{ route('cart.index') }}"
			})
		})
	})
})();

</script>
@endsection