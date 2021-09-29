@extends('layout.app')
@section('title','Companies List')

@section('content')
    <div class="content-wrapper">
        @if ($message = Session::get('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <p class="text-white">{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
            @if ($message = Session::get('fail'))
                <div class="alert alert-danger alert-warning alert-dismissible fade show" role="alert">
                    <p class="text-white">{{ $message }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
        @endif
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Companies Page</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Companies Page</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="card card-primary">
                <form method="GET" action="{{route('company.index')}}">
                    <div class="card-body row">
                        <div class="form-group col-sm">
                            <label>Name</label>
                            <input type="name" name="name" class="form-control" placeholder="Name..." id="name" value="{{request()->get('name')}}">
                        </div>
                        <div class="form-group col-sm">
                            <label>Address</label>
                            <input type="name" name="address" class="form-control" placeholder="Address..." value="{{request()->get('address')}}">
                        </div>
                        <div class="form-group col-sm">
                            <label>Phone</label>
                            <input type="name" name="phone" class="form-control" placeholder="Phone..." value="{{request()->get('phone')}}">
                        </div>
                        <div class="form-group col-sm">
                            <label>E-mail</label>
                            <input type="name" name="email" class="form-control" placeholder="E-mail..." value="{{request()->get('email')}}">
                        </div>
                        <div class="form-group col-sm">
                            <label>Website</label>
                            <input type="name" name="website" class="form-control" placeholder="Website..." value="{{request()->get('website')}}">
                        </div>
                    </div>
                    <div class="card-footer row">
                        <div class="buttonSearch">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                        <div class="buttonReset ml-2">
                            <a class="btn btn-primary" href="{{route('company.index')}}">Reset</a>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card">
                <div class="card-header">
                    <a href="{{route('company.create')}}" type="button" class="btn btn-block btn-info" style="width:200px">Add Company</a>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <table id="dt-basic-checkbox" class="table table-bordered table-striped">
                                <thead>
                                <tr role="row">
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>E-mail</th>
                                    <th>Logo</th>
                                    <th>Website</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($datalist as $rs)
                                    <tr class="odd">
                                        <td>{{$rs->id}}</td>
                                        <td>{{$rs->name}}</td>
                                        <td>{{$rs->address}}</td>
                                        <td>{{$rs->phone}}</td>
                                        <td>{{$rs->email}}</td>
                                        <td>
                                            @if($rs->logo)
                                                <img src="{{Storage::url($rs->logo)}}" height="100" width="100" alt="">
                                            @endif

                                        </td>
                                        <td><a href="{{$rs->website}}">{{$rs->website}}</a></td>
                                        <td><a href="{{route('company.edit',$rs->id)}}">Edit</a></td>
                                        <td><a href="{{route('company.destroy',$rs->id)}}" onclick="return confirm('Delete! Are you sure you want to delete {{$rs->name}} company?')">Delete</a></td>
                                   </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </section>
    </div>

@endsection

@section('footer')
    <script src="{{asset('admin')}}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{asset('admin')}}/plugins/jszip/jszip.min.js"></script>
    <script src="{{asset('admin')}}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{asset('admin')}}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{asset('admin')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
            })
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        $('#dt-basic-checkbox').dataTable({
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }],
            select: {
                style: 'os',
                selector: 'td:first-child'
            }
        });
    </script>
@endsection

