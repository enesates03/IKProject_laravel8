@extends('layout.app')
@section('title','Edit Camponies Page')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Campany Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Edit Campany</a></li>
                            <li class="breadcrumb-item active">Edit Campany Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Campany Page</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" action="{{route('company.update',$data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name" value="{{$data->name}}" id="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" value="{{$data->address}}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" value="{{$data->phone}}" class="form-control">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" value="{{$data->email}}" class="form-control">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" id="logo" value="{{$data->logo}}" class="form-control">
                            </div>

                            @if($data->logo)
                            <div class="form-group">
                                    <img id="preview-image-before-upload" src="{{Storage::url($data->logo)}}" height="250" alt="">
                                @else
                                    <img src="https://www.riobeauty.co.uk/images/product_image_not_found.gif" alt="preview image" style="max-height: 250px;">
                            </div>
                            @endif

                            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                            <script type="text/javascript">
                                $(document).ready(function (e) {
                                    $('#logo').change(function(){
                                        let reader = new FileReader();
                                        reader.onload = (e) => {
                                            $('#preview-image-before-upload').attr('src', e.target.result);
                                        }
                                        reader.readAsDataURL(this.files[0]);
                                    });
                                });
                            </script>

                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="website" value="{{$data->website}}" class="form-control">
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
