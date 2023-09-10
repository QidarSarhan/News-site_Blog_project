@extends('dashboard.layouts.layout')

@section('body')
    <!-- Breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">{{ __('words.dashboard') }}</li>
        <li class="breadcrumb-item"><a href="#">{{ __('words.dashboard') }}</a>
        </li>
        <li class="breadcrumb-item active">داشبرد</li>
    </ol>

    {{-- {{dd($setting)}} --}}
    <div class="container-fluid">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Striped Table
                </div>
                <div class="card-block">
                    <table class="table table-striped" id="table_id">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Date registered</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            {{-- <tr>
                                <td>Yuro</td>
                                <td>2023/1/1</td>
                                <td>Member</td>
                                <td>
                                    <span class="tag tag-success">Action</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>suro</td>
                                <td>2023/2/1</td>
                                <td>Staff</td>
                                <td>
                                    <span class="tag tag-danger">Banned</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>muro</td>
                                <td>2023/3/1</td>
                                <td>Writer</td>
                                <td>
                                    <span class="tag tag-warning">Banned</span>
                                </td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>kuro</td>
                                <td>2023/4/1</td>
                                <td>Admin</td>
                                <td>
                                    <span class="tag tag-default">inaction</span>
                                </td>
                                <td></td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection


    {{-- delete --}}
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ Route('dashboard.users.delete') }}" method="POST">
                <div class="modal-content">

                    <div class="modal-body">
                        @csrf

                        <div class="form-group">
                            <p>{{ __('words.sure delete') }}</p>
                            @csrf
                            <input type="hidden" name="id" id="id">
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">{{ __('words.close') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('words.delete') }} </button>
                    </div>
                </div>
            </form>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    {{-- delete --}}




@push('javascripts')


    <script type="text/javascript">
        $(function() {
            let table = $('#table_id').DataTable({
                // retrieve: true,
                processing: true,
                serverSide: true,
                ajax: "{{ Route('dashboard.users.all') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

        });

        $('#table_id tbody').on('click', '#deleteBtn', function(argument) {
            var id = $(this).attr("data-id");
            console.log(id);
            $('#deletemodal #id').val(id);
        })
    </script>
@endpush
