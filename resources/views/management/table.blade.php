@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar')
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-chair"></i> Table</h5>
                <a href="/management/table/create" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>
                Create Table
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
                        <th scope="col" class="text-center">Table</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Edit</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tables as $table)
                    <tr>
                        <td>{{$table->id}}</td>
                        <td>{{$table->name}}</td>
                        <td>{{$table->status}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="/management/table/{{$table->id}}/edit" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                        <div class="text-center">
                                <form action="/management/table/{{$table->id}}" method="post">
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
            </div>
        </div>
    </div>
@endsection