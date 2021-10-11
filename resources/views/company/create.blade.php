@extends('layout.app')
@section('title','Add Camponies Page')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add Company Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Add Company</a></li>
                            <li class="breadcrumb-item active">Add Company Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Add Company Page</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" action="{{route('company.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{old('name')}}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control" value="{{old('address')}}">
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" value="{{old('phone')}}">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>E-mail</label>
                                <input type="text" name="email" class="form-control" value="{{old('email')}}">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Logo</label>
                                <div class="custom-file">
                                <input type="file" name="logo" id="logo" class="custom-file-input" value="{{ old('logo')  }}">
                                <label class="custom-file-label" for="exampleInputFile" >Choose file</label>
                                </div>
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group" >
                                <img id="preview-image-before-upload" height="250" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                     alt="preview image" style="max-height: 250px;">
                            </div>
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
                            <script>
                                $(".custom-file-input").on("change", function() {
                                    var fileName = $(this).val().split("\\").pop();
                                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                });
                            </script>

                            <div class="form-group">
                                <label>Website</label>
                                <input type="text" name="website" class="form-control" value="{{old('website')}}">
                                @error('website')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </section>
    </div>
@endsection

