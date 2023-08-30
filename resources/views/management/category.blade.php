@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar')
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-align-justify"></i> Category</h5>
                <a href="/management/category/create" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>
                Create Category
                </a>
                </div>
                <hr>
                @if(Session()->has('status'))
                    <div class="alert alert-success">
                        {{ Session()->get('status') }}
                    </div>
                @endif
                <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col" class="text-center">Category</th>
                        <th scope="col" class="text-center">Edit</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <th scope="row" class="text-center">{{ $category->id }}</th>
                        <td>{{ $category->name }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="/management/category/{{$category->id}}/edit" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                            <div class="text-center">
                                <form action="/management/category/{{$category->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-danger">
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                @if ($categories->currentPage() > 1)
                    <a href="{{ $categories->previousPageUrl() }}" class="btn btn-primary">Previous</a>
                @endif

                @if ($categories->hasMorePages())
                    <a href="{{ $categories->nextPageUrl() }}" class="btn btn-primary">Next</a>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection