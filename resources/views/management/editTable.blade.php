@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
        @include('management.inc.sidebar')
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-chair"></i> Edit A Table</h5>
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
                <form action="/management/table/{{$table->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                    <label for="categoryName" class="form-label">Table Name</label>
                    <input type="text" name="name" class="form-control" id="tableName" placeholder="Table..." value="{{$table->name}}">
                    </div>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </form>
            </div>
        </div>
    </div>
@endsection