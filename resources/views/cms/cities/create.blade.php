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
                <h3 class="card-title">{{__('cms.create_user')}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{route('cities.store')}}" enctype="application/x-www-form-urlencoded">
                @csrf
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                  <ul>
                  @foreach($errors->all() as $error)
                  <li>
                    {{$error}}
                  </li>
                  @endforeach
                  </ul>
                </div>
                @endif
                @if(session()->has('massage'))
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-check"></i> Success</h5>
                  {{session()->get('massage')}}
                </div>
                @endif

                  <div class="form-group">

                    <label for="name_en">{{__('cms.name_en')}}</label>
                    <input type="text" class="form-control" id="name_en" name="name_en" value="{{old('name_en')}}" placeholder="{{__('cms.name_en')}}">
                  </div>
                  <div class="form-group">
                    <label for="name_ar">{{__('cms.name_ar')}}</label>
                    <input type="text" class="form-control" id="name_ar" name="name_ar" value="{{old('name_ar')}}" placeholder="{{__('cms.name_ar')}}">
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-switch">
                      <input type="checkbox" class="custom-control-input" id="active" name="active">
                      <label class="custom-control-label" for="active">{{__('cms.active')}}</label>
                    </div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button  type="submit" class="btn btn-primary">{{__('cms.save')}}</button>
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
@endsection
