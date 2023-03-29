@extends('cms.parant')

@section('title',__('cms.users'))
@section('page-lg',__('cms.index'))
@section('main-pg-md',__('cms.users'))
@section('page-md',__('cms.index'))


@section('styles')
@endsection
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{__('cms.users')}}</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>{{__('cms.name')}}</th>
                                    <th>{{__('cms.email')}}</th>
                                    <th>{{__('cms.city')}}</th>
                                    <th>{{__('cms.created_at')}}</th>
                                    <th>{{__('cms.updated_at')}}</th>

                                    <th style="width: 40px">{{__('cms.settings')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->city->name_en}}</td>
                                    <!-- //<td>{{$user->city->name_en}}</td> right join -->
                                    <td>{{$user->created_at}}</td>
                                    <td>{{$user->updated_at}}</td>


                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="#" onclick="confirmDalate('{{$user->id}}',this)" class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>




                                    <!-- <td>
                        <div class="progress progress-xs">
                          <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                        </div>
                      </td> -->
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">

                    </div>
                </div>
                <!-- /.card -->


            </div>

        </div>
        <!-- /.row -->


    </div><!-- /.container-fluid -->
</section>
@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    function confirmDalate(id,refernce) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                performDelete(id,refernce);

            }
        });

    }
    function performDelete(id, refernce){
        axios.delete('/cms/admain/users/'+id)
            .then(function (response) {
                console.log(response);
                // toastr.success('response.date.message');
                refernce.closest('tr').remove();
                showMessge(response.data);
            })
            .catch(function (error) {
                    console.log(error.response);
                    // toastr.error(error.response.data.message);
                    showMessge(error.response.data);

                });
                }
        function showMessge(message){
                Swal.fire(
                    data.text,
                    data.title,
                    data.icon
                );
        }

</script>
@endsection
