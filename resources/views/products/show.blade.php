@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-between my-3">
            <div class="pull-left">
                <h4>Product Details</h4>
            </div>
            <div class="pull-right">
                <a class="btn btn-outline-primary" href="{{ route('products.index') }}"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>

    <div class="card">
        <img src="{{url($product->image)}}" class="card-img-top" style="height:300px;width:400px;" alt="{{ $product->name }}">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text"> Price : ₹{{ $product->price }}</p>
            <p class="card-text"> Category : ₹{{ $product->category }}</p>
            <p class="card-text"> Description: {{ $product->description }}</p>
            <a href="{{route('products.edit',$product)}}" class="btn btn-primary">Edit Details</a>
        </div>
    </div>
</div>

@endsection
