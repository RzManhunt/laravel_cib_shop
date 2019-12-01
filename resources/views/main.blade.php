@extends('layout.app')

@section('hero-header', 'hero-header')
@section('nav-bg', 'bg-dark')

@section('header-content')
    <div class="col-md-8 d-flex px-0 pt-4 pb-2">
        <div class="col d-flex flex-column pb-5 px-0">
            <h1 class="font-weight-bold text-white">Tienda CIB</h1>
            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
            <div>
                <a href="#" class="btn border-white px-4 text-white">Blog</a>
                <a href="#" class="btn border-white ml-3 px-4 text-white">Tienda</a>
            </div>
        </div>
        <div class="col d-flex justify-content-center pb-5 px-0">
            Imagen de una mujer modelando
        </div>
    </div>
@endsection

@section('content')
<main class="row d-flex justify-content-center">
    <div class="col-md-8 d-flex flex-column px-0 py-5 mb-5">
        <section class="d-flex flex-column align-items-center">
            <h2 class="align-self-start">Tienda CIB</h2>
            <p class="">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad mini.</p>
            <a href="#" class="btn border-dark px-5 mb-5 text-dark">Destacados</a>
        </section>

        <section class="container-fluid d-flex flex-column align-items-center">
            <div class="row">
                @foreach($products as $product)
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
                @endforeach
            </div>
            <a href="{{ route('shop.index') }}" class="btn border-dark text-dark py-2 px-4 mb-5 mt-2">
                Ver mas productos
            </a>
        </section>

        <section class="container-fluid mt-4">
            <h2 class="font-weight-bold">Nuestro Blog</h2>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
            </p>
            <div class="row mt-2">
                <div class="col-md-4 mb-4">
                    <img src="" class="w-100">
                    <h5 class="font-weight-bold">Blog Post Title 1</h5>
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                    </span>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="" class="w-100">
                    <h5 class="font-weight-bold">Blog Post Title 2</h5>
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                    </span>
                </div>
                <div class="col-md-4 mb-4">
                    <img src="" class="w-100">
                    <h5 class="font-weight-bold">Blog Post Title 3</h5>
                    <span>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.
                    </span>
                </div>
            </div>
        </section>
    </div>
</main>
@endsection