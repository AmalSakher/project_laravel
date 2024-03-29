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
                <h3 class="card-title">{{__('cms.create_city')}}</h3>
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
                    <option selected="selected " value="{{$city->id}}">{{$city->name_en}}</option>
                    @endforeach

                  </select>
                </div>
                  <div class="form-group">

                    <label for="name">{{__('cms.name')}}</label>
                    <input type="text" class="form-control" id="name"  placeholder="{{__('cms.name')}}">
                  </div>
                  <div class="form-group">
                    <label for="email">{{__('cms.email')}}</label>
                    <input type="email" class="form-control" id="email"   placeholder="{{__('cms.email')}}">
                  </div>


                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                            <button type="button" onclick="performStore()"
                                class="btn btn-primary">{{__('cms.save')}}</button>
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
<!-- <script src="{{asset('js/axios.js')}}"></script> -->
<script>
    function performStore(){
        // alert('perom Store _fun Js');
        // console.log('peromStore');
        axios.post('/cms/admain/users', {
        name: document.getElementById('name').value,
        email_address: document.getElementById('email').value,
        city_id: document.getElementById('city_id').value,
    })
    .then(function (response) {
        console.log(response);
        toastr.success(response.data.message);
        document.getElementById('create-form').reset();
        
    })
    .catch(function (error) {
        console.log(error.response);
        toastr.error(error.response.data.message);
    });
        }
</script>
@endsection
