@extends('layout.app')

@section('title', ' | ' . $product->name)

@section('nav-bg', 'bg-dark')

@section('content')
	<nav class="bg-lightgray row d-flex justify-content-center py-2">
		<ul class="col-md-8 breadcrumb m-0">
			<li><a href="{{ url('/') }}">Home</a></li>
			<li><a href="{{ route('shop.index') }}">Comprar</a></li>
			<li>{{ $product->name }}</li>
		</ul> 
	</nav>

	<main>
	<div class="row d-flex justify-content-center py-3">
    	<section class="col-md-8 d-flex px-0 pt-5 pb-4">
    		<div class="col d-flex justify-content-center align-items-center">
    			<img class="w-100 h-100" src="{{ asset('img/' . substr($product->slug, strripos($product->slug, '-') + 1) . '.png') }}" alt="{{ $product->name }}">
    		</div>
    		<div class="col d-flex flex-column">
    			<h2 class="font-weight-bold m-0">{{ $product->name }}</h2>
    			<span class="text-info">{{ $product->details }}</span>
    			<h2 class="font-weight-bold">{{ $product->presentPrice() }}</h2>
		        <p class="">{{ $product->description }}
		        </p>
		        <form action="{{ route('cart.store') }}" method="POST">
		        	@csrf
		        	@method('PUT')
		        	<input type="hidden" name="id" value="{{ $product->id }}" />
		        	<input type="hidden" name="name" value="{{ $product->name }}" />
		        	<input type="hidden" name="price" value="{{ $product->price }}" />
		        	<input type="hidden" name="slug" value="{{ $product->slug }}" />
		        	<input type="hidden" name="details" value="{{ $product->details }}" />
			        <input type="submit" value="Agregar al Carro" class="btn border-dark px-5 text-dark mt-3" />
			    </form>
    		</div>
    	</section>
	</div>
	<div class="row d-flex justify-content-center py-2 bg-lightgray">
		<div class="col-md-8 d-flex flex-column px-0">
						
			@include('includes.might-like')

		</div>
	</div>
    </main>
@endsection