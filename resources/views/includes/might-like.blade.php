<div class="bg-lightgray w-100">
		<h5 class="font-weight-bold pt-4 pb-2">
			Tambien te puede interesar...
		</h5>
		<section class="container-fluid pb-4">
			<div class="row">
		@foreach($mightAlsoLike as $product)
			<a href="{{ route('shop.show', ['slug' => $product->slug]) }}" class="px-3 slide-article overflow-hidden d-flex flex-column col-md-3">
				<img class="w-100 h-100" src="{{ asset('img/' . substr($product->slug, strripos($product->slug, '-') + 1) . '.png') }}" alt="{{ $product->name }}">
				<div>{{ $product->name }}</div>
			</a>
		@endforeach
			</div>
		</section>
</div>
