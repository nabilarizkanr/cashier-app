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
                <h5><i class="fas fa-user"></i> Edit a User</h5>
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
                <form action="/management/user/{{$user->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Name...">
                    </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control"  placeholder="Email...">
                    </div>
                    <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control"  placeholder="Password...">
                    </div>
                    <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control">
                        <option value="admin" {{$user->role == 'admin' ? 'selected' : ''}}>Admin</option>
                        <option value="cashier" {{$user->role == 'cashier' ? 'selected' : ''}}>Cashier</option>
                    </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
@endsection