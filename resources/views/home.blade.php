@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Main Function') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row text-center">
                        @if(Auth::user()->checkAdmin())
                        <div class = col-sm-4>
                            <a href="/management">
                            <h5>Management</h5>
                            <img src="{{ asset('images/web-management.png') }}" alt="Management" width="50">
                            </a>
                        </div>
                        @endif
                        <div class = col-sm-4>
                            <a href="/cashier">
                            <h5>Cashier</h5>
                            <img src="{{ asset('images/cash-machine.png') }}" alt="Cashier" width="50">
                            </a>
                        </div>
                        @if(Auth::user()->checkAdmin())
                        <div class = col-sm-4>
                            <a href="/report">
                            <h5>Report</h5>
                            <img src="{{ asset('images/seo-report.png') }}" alt="Report" width="50">
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
