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
                                    <h4>Edit Section</h4>
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('section.index') }}" class="btn btn-primary float-right">Back</a>
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
                            <form action="{{ route('section.update',$section->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="other_data"></div>
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Section Name</h6>
                                                    <input type="text" min="0" name="assemblyGroupName"
                                                        class="form-control" required
                                                        value="{{ $section->assemblyGroupName }}">
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Has Childs</h6>
                                                    <select name="hasChilds" id="" class="form-control">
                                                        <option value="0" {{ $section->hasChilds == 0 ? 'selected' : '' }}>0</option>
                                                        <option value="1" {{ $section->hasChilds == 1 ? 'selected' : '' }}>1</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Short Cut ID</h6>
                                                    <input type="number" name="shortCutId" class="form-control" required
                                                        value="{{ $section->shortCutId }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">
                                                <h6>Select Language</h6>
                                                <select name="lang" id="" class="form-control">
                                                    @foreach ($languages as $lang)
                                                        <option value="{{ $lang->lang }}" {{ $section->lang == $lang->lang ? 'selected' : '' }}>{{ $lang->languageName }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Select Engine</h6>
                                                    <select name="request__linkingTargetId" id=""
                                                        class="form-control">
                                                        @foreach ($engines as $engine)
                                                            <option value="{{ $engine->linkageTargetId }}" {{ $section->request__linkingTargetId == $engine->linkageTargetId ? 'selected' : '' }}>
                                                                {{ $engine->description }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-group">
                                                    <h6>Parent Section</h6>
                                                    <select name="parentNodeId" id="parentNodeId"  class="form-control">
                                                        <option>select parent</option>
                                                        @foreach ($sections as $sec)
                                                            <option value="{{ ($section->parentNodeId == $sec->assemblyGroupNodeId) ? $section->parentNodeId : $sec->assemblyGroupNodeId}}" {{ ($section->parentNodeId == $sec->assemblyGroupNodeId) ? "selected" : ""}}>{{ $sec->assemblyGroupName}}</option>
                                                        @endforeach
                                                    </select>
                                                    {{-- <input type="number" min="0" name="parentNodeId"
                                                        class="form-control" required value="{{ $section->parentNodeId }}"> --}}
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

        <script></script>
    </section>
@endsection
