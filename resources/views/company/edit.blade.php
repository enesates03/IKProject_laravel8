@extends('layout.app')
@section('title','Edit Camponies Page')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Camponies Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Edit Camponies</a></li>
                            <li class="breadcrumb-item active">Edit Camponies Page</li>
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
                    <h3 class="card-title">Edit Camponies Page</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">

                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{route('company_update',['id' => $data->id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$data->name}}" id="name">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Hatalı işlem isim kısmı boş bırakılamaz</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{$data->address}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{$data->phone}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" value="{{$data->email}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" value="{{$data->email}}" class="form-control">
                            </div>

                            @if($data->logo)
                                <img src="{{Storage::url($data->logo)}}" height="100" alt="">
                            @endif

                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="website" value="{{$data->website}}" class="form-control">
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

