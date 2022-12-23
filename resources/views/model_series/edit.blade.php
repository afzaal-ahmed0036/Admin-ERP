@extends('layout.main')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible text-center"><button type="button" class="close"
                data-dismiss="alert" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>{{ session()->get('message') }}</div>
    @endif
    @if (session()->has('not_permitted'))
        <div class="alert alert-danger alert-dismissible text-center"><button type="button" class="close" data-dismiss="alert"
                aria-label="Close"><span aria-hidden="true">&times;</span></button>{{ session()->get('not_permitted') }}
        </div>
    @endif

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>{{ trans('file.Edit Model') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('modelseries.index') }}" class="btn btn-primary float-right">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('error'))
                                <p class="bg-danger text-white p-2 rounded">{{ Session::get('error') }}</p>
                            @endif
                            @if (Session::has('success'))
                                <p class="bg-success text-white p-2 rounded">{{ Session::get('success') }}</p>
                            @endif
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('modelseries.update',$modelSeries->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="other_data"></div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Model Name:</h6>
                                                    <input type="text" name="modelname" class="form-control" required
                                                        value="{{ $modelSeries->modelname }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Year of Construction From:</h6>
                                                    <select class="js-example-placeholder-multiple col-sm-12 form-control" name="yearOfConstrFrom">
                                                        <option value="-2">Select Year</option>
                                                        @foreach(range( $latest_year, $earliest_year ) as $i)
                                                        <option value="{{ $i }}" {{ $i == $modelSeries->yearOfConstrFrom ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endforeach
                        
                                                    </select>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Year of Construction To:</h6>
                                                    <select class="js-example-placeholder-multiple col-sm-12 form-control" name="yearOfConstrTo">
                                                        <option value="-2">Select Year</option>
                                                        @foreach(range( $latest_year, $earliest_year ) as $i)
                                                        <option value="{{ $i }}" {{ $i == $modelSeries->yearOfConstrTo ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endforeach
                        
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Manufacturer:</h6>
                                                    <select name="manuId" id="" class="form-control"
                                                        required>
                                                        <option value="" selected disabled>--Select One--</option>
                                                        @foreach ($manufacturers as $manufacturer)
                                                            <option value="{{ $manufacturer->manuId }}" {{ $manufacturer->manuId == $modelSeries->manuId ? 'selected' : '' }}>
                                                                {{ $manufacturer->manuName }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Linkage Target Type:</h6>
                                                    <select name="linkingTargetType" id="" class="form-control"
                                                        required>
                                                        <option value="" selected disabled>--Select One--</option>
                                                        <option value="P" {{ $modelSeries->linkingTargetType == "P" ? 'selected' : '' }}>P</option>
                                                        <option value="V" {{ $modelSeries->linkingTargetType == "V" ? 'selected' : '' }}>V</option>
                                                        <option value="L" {{ $modelSeries->linkingTargetType == "L" ? 'selected' : '' }}>L</option>
                                                        <option value="B" {{ $modelSeries->linkingTargetType == "B" ? 'selected' : '' }}>B</option>
                                                        <option value="C" {{ $modelSeries->linkingTargetType == "C" ? 'selected' : '' }}>C</option>
                                                        <option value="T" {{ $modelSeries->linkingTargetType == "T" ? 'selected' : '' }}>T</option>
                                                        <option value="M" {{ $modelSeries->linkingTargetType == "M" ? 'selected' : '' }}>M</option>
                                                        <option value="A" {{ $modelSeries->linkingTargetType == "A" ? 'selected' : '' }}>A</option>
                                                        <option value="K" {{ $modelSeries->linkingTargetType == "K" ? 'selected' : '' }}>K</option>
                                                        <option value="O" {{ $modelSeries->linkingTargetType == "O" ? 'selected' : '' }}>O</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="d-flex flex-row-reverse">
                                            <button type="submit" class="btn btn-primary" style="width:100px">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </section>
@endsection
