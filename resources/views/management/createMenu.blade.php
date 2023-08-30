@extends('layouts.app')
<style>
    .form-group {
        margin-bottom: 20px; /* Atur margin bawah untuk form-group */
    }
    
    .btn {
        margin-top: 10px; /* Atur margin atas untuk tombol */
    }
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
        @include('management.inc.sidebar')
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-hamburger"></i> Create A Menu</h5>
                </div>
                <hr>
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="/management/menu" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                    <label for="menuName" class="form-label">Menu Name</label>
                    <input type="text" name="name" class="form-control" id="categoryName" placeholder="Menu...">
                    </div>
                    <label for="menuPrice">Price</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp.</span>
                        </div>
                        <input type="text" name="price" class="form-control" aria-label="Amount">
                        <div class="input-group-append">
                        </div>
                    </div>
                    <label for="MenuImage">Image</label>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" id="inputGroupFile02" name="image">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>

                    <div class="form-group">
                        <label for="Description">Description</label>
                        <input type="text" name="description" class="form-control" placeholder="Description...">
                    </div>

                    <div class="form-group">
                        <label for="Category">Category</label>
                        <select class="form-control" name="category_id">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection