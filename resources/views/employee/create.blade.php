@extends('layout.app')
@section('title','Add Camponies Page')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Employee Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Add Employee</a></li>
                            <li class="breadcrumb-item active">Add Employee Page</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Employee Page</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('employee.store')}}" method="post">
                        @csrf

                        <div class="card-body">

                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" id="name">
                                @error('firstname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Eksik alan girişi isim kısmı boş bırakılamaz</strong>
                                </span>
                                @enderror

                            </div>

                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" id="name1">
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Eksik alan girişi isim kısmı boş bırakılamaz</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="name2">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Eksik alan girişi isim kısmı boş bırakılamaz</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Company</label>
                                <select class="form-control select2" name="company" style="width:100%">
                                    @foreach($datalist as $rs)
                                        <option value="{{$rs->id}}">{{$rs->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <!-- /.card-body -->
                        <button type="submit" class="btn btn-primary">Add Companies</button>
                    </form>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection

