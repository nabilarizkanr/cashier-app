<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<script src="{{ asset('js/app.js') }}"></script>
<script type="text/javascript" src="https://momentjs.com/downloads/moment.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-5">
                
                @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>{{$error}}
                        @endforeach
                    </ul>
                </div>
                @endif
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Main Functions</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Report</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
    <form action="/report/show" method="GET" class="col-md-12">
        <div class="form-group">
            <label for="dateFrom">Choose Date Range For Report</label>
            <div class="row">
                <div class="col-sm-4">
                    <div class="input-group date" id="dateFromPicker">
                        <input type="text" class="form-control" id="dateFrom" name="dateFrom" placeholder="From">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="input-group date" id="dateToPicker">
                        <input type="text" class="form-control" id="dateTo" name="dateTo" placeholder="To">
                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar"></i>
                            </span>
                        </span>
                    </div>
                </div>
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>
            </div>
        </div>
    </form>
</div>

</div>

<script src="/js/app.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.11.4/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
   $(function() {
        $('#dateFrom').datepicker();
        $('#dateTo').datepicker();
    });
</script>
@endsection