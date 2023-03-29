@extends('cms.parant')

@section('title','Cities')
@section('page-lg','Index')
@section('main-pg-md','Cities')
@section('page-md','Index')


@section('styles')
@endsection
@section('content')
<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">{{__('cms.edit_city')}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form  id="create-form">
                @csrf
                <div class="card-body">
                <div class="form-group">
                  <label>{{__('cms.city')}}</label>
                  <select class="form-control" id="city_id" >
                  @foreach($cities as $city)
                    <option  value="{{$city->id}}" @if($user->city_id == $city->id) selected @endif> {{$city->name_en}}</option>
                    @endforeach

                  </select>
                </div>
                  <div class="form-group">

                    <label for="name">{{__('cms.name')}}</label>
                    <input type="text" class="form-control" id="name"  placeholder="{{__('cms.name')}}" value="{{$user->name}}">
                  </div>
                  <div class="form-group">
                    <label for="email">{{__('cms.email')}}</label>
                    <input type="email" class="form-control" id="email"   placeholder="{{__('cms.email')}}" value="{{$user->email}}">
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button  type="button" onclick="perfromUpdate('{{$user->id}}')" class="btn btn-primary" >{{__('cms.save')}} </button>
                </div>
              </form>
            </div>
            <!-- /.card -->



          </div>
          <!--/.col (left) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
@section('scripts')
<script src="{{asset('js/axios.js')}}"></script>
<script>
    function perfromUpdate(id){
        // alert('perom Store _fun Js');
        // console.log('peromStore');
        axios.put('/cms/admain/users/{{$user->id}}', {
        name: document.getElementById('name').value,
        email_address: document.getElementById('email').value,
        city_id: document.getElementById('city_id').value,
    })
    .then(function (response) {
        console.log(response);
        toastr.success('response.date.message');
        window.location.href = '/cms/admain/users';
    })
    .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
        }
</script>
@endsection
