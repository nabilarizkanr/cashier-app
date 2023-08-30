@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('management.inc.sidebar')
            <div class="col-md-8">
                <div class="d-flex justify-content-between align-items-center">
                <h5><i class="fas fa-hamburger"></i> Menu</h5>
                <a href="/management/menu/create" class="btn btn-success btn-sm">
                <i class="fas fa-plus"></i>
                Create Menu
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
                        <th scope="col" class="text-center">Name</th>
                        <th scope="col" class="text-center">Price</th>
                        <th scope="col" class="text-center">Picture</th>
                        <th scope="col" class="text-center">Description</th>
                        <th scope="col" class="text-center">Category</th>
                        <th scope="col" class="text-center">Edit</th>
                        <th scope="col" class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->id}}</td>
                        <td>{{$menu->name}}</td>
                        <td>{{$menu->price}}</td>
                        <td>
                            <img src="{{asset('menu_images/')}}/{{$menu->image}}" alt="{{$menu->name}}"
                             class="img-thumbnail">
                        </td>
                        <td>{{$menu->description}}</td>
                        <td>{{$menu->category->name}}</td>
                        <td class="d-flex justify-content-center">
                            <a href="/management/menu/{{$menu->id}}/edit" class="btn btn-warning">Edit</a>
                        </td>
                        <td>
                        <div class="text-center">
                                <form action="/management/menu/{{$menu->id}}" method="post">
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