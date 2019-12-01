@extends('layout.app')

@section('nav-bg', 'bg-dark')

@section('content')
	<nav class="bg-lightgray row d-flex justify-content-center py-2">
		<ul class="col-md-8 breadcrumb m-0">
			<li><a href="{{ url('/') }}">Home</a></li>
			<li>Comprar</li>
		</ul> 
	</nav>

	<main class="row d-flex justify-content-center py-3">
    	<section class="col-md-8 d-flex px-0 py-5 mb-5">
    		<aside class="col-md-3 d-flex flex-column">
    			<section class="d-flex flex-column">
    				<h5 class="font-weight-bold pb-2 pt-3">Categorias</h5>
                    @foreach($categories as $category)
                    <a 
                    href="{{ route('shop.index', ['category' => $category->slug]) }}"
                    class="{{ $category->slug == request()->category ? 'font-weight-bold' : '' }} text-dark"
                    >
                    {{ $category->name }}
                    </a>
                    @endforeach

    				<h5 class="font-weight-bold pt-4 pb-2">Ordenar</h5>                  
    				<a class="text-dark" href="{{ route('shop.index', ['category' => request()->category, 'orderBy' => 'asc']) }}">
                        Menor Precio
                    </a>
    				<a class="text-dark" href="{{ route('shop.index', ['category' => request()->category, 'orderBy' => 'desc']) }}">
                        Mayor Precio
                    </a>
    			</section>
    		</aside>
    		<div class="col-md-9 d-flex flex-column align-items-start">
    			<h2 class="font-weight-bold">
    				<div class="title-decorator mb-1"></div>
    					{{ $category_name }}
    				<div class="title-decorator mt-1"></div>
    			</h2>
    			<div class="w-100 row">

                    
				@forelse($products as $product)
                <div class="product-card col-md-3 py-3">
                    <div class="container-fluid d-flex flex-column p-0">
                    <a href="{{ route('shop.show', ['slug' => $product->slug]) }}">
                        <img class="product-image" src="{{ $product->presentProductImage() }}" alt="{{ $product->name }}">
                    </a>
                    <a href="{{ route('shop.show', ['slug' => $product->slug]) }}">
                        {{ $product->name }}
                    </a>
                    <div>{{ $product->presentPrice() }}</div>
                    </div>
                </div>
                @empty
                    <div class="font-weight-bold p-4">
                        No existen Productos para esta categoria
                    </div>
                @endforelse

                <div class="container-fluid d-flex justify-content-center mt-5">
                    {{ $products->links() }}
                </div>
                

    			</div>
    		</div>
    	</section>
    </main>
@endsection