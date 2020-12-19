

@extends('layouts.master')

@section('content')
  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
      @foreach ($products as $product)
          
      <div class="col-lg-4">
        <img src="{{ $product->image }}" width="150" height="150">
        <h2>{{ $product->title }}</h2>
        <p>{{ $product->description }}</p>
        <p>{{ '$' . number_format($product->price,2) }}</p>

        <p>
          <form action="{{ route('cart.store') }}" method="POST">
           @csrf
           <input type="hidden" name="id" value="{{$product->id}}">
           <input type="hidden" name="title" value="{{$product->title}}">
           <input type="hidden" name="price" value="{{$product->price}}">
           <button type="submit" class="btn btn-secondary">Add to cart </button>
          </form>
        </p>
      </div><!-- /.col-lg-4 -->
      @endforeach

    </div><!-- /.row -->
  </div><!-- /.container -->

@endsection