@extends('layout.app')
@section('title','Edit Employee Page')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Employee Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Edit Employee</a></li>
                            <li class="breadcrumb-item active">Edit Employee Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Employee Page</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                   {{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Please correct errors and try again!.
                            <br/>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif--}}
                    <form role="form" action="{{route('employee.update',$data->id)}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{$data->firstname}}" id="firstname">
                                @error('firstname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                              {{--  @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Missing field entry firstname part cannot be left blank</strong>
                                </span>
                                @enderror--}}
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{$data->lastname}}" id="firstname">
                                @error('lastname')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                             {{--   @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Missing field entry lastname part cannot be left blank</strong>
                                </span>
                                @enderror--}}
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">E-mail</label>
                                <input type="text" name="email" value="{{$data->email}}" class="form-control">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword1">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$data->phone}}" id="firstname">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                             {{--   @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Missing field entry phone part cannot be left blank</strong>
                                </span>
                                @enderror--}}
                            </div>

                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control select2" name="company" style="width:100%">
                                    @foreach($datalist as $rs)
                                        <option value="{{$rs->id}}" @if ($rs->id== $data->company)  selected="selected"  @endif>{{$rs->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </section>
    </div>
@endsection


