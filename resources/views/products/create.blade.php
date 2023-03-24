@extends('layouts.app')
@section('content')
    <div class="container">
        <form class="row g-3" action="{{route('products.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-md-6">
                <label for="inputName" class="form-label">Product Name : <span class="text-danger">*</span> </label>
                <input type="text" name="name" class="form-control" id="inputName">
                @error('name')
                    <span class="text-danger" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="inputCategory" class="form-label">Category : <span class="text-danger">*</span> </label>
                <select class="form-select" id="inputCategory" name="category">
                    <option value="" selected>---</option>
                    @foreach ($categories as $category)
                        <option value="{{$category}}">{{$category}}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="text-danger" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="inputPrice" class="form-label">Price : <span class="text-danger">*</span> </label>
                <div class="input-group">
                    <span class="input-group-text">₹</span>
                    <input type="number" id="inputPrice" class="form-control" name="price">
                </div>
                @error('price')
                    <span class="text-danger" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-md-6">
                <label for="inputDiscount" class="form-label">Discount :</label>
                <div class="input-group mb-3">
                    <span class="input-group-text">%</span>
                    <input type="number" id="inputDiscount" class="form-control" name="discount">
                </div>
            </div>
            <div class="mb-3 col-md-12">
                <label for="inputFile" class="form-label">Product Image :</label>
                <input class="form-control" type="file" id="inputFile" name="image" accept="image/*" >
                @error('image')
                    <span class="text-danger text-sm" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                @enderror
            </div>
            <div class="mb-3 col-md-12">
                <div class="form-floating">
                    <textarea class="form-control" name="description" placeholder="Description" id="floatingTextarea2"></textarea>
                    <label for="floatingTextarea2">Description</label>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <a class="btn btn-outline-secondary mx-2" href="{{route('products.index')}}"><i class="fa-solid fa-arrow-left"></i> Back</a>
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-plus"></i> Add Product</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
@endsection
