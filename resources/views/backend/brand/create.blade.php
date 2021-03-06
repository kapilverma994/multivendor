@extends('backend.layouts.master')
@section('content')
<div class="col-lg-8 ">
    <!-- Form Basic -->
    <div class="card mb-4">
      @include('backend.layouts.notify')
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      
        <h6 class="m-0 font-weight-bold text-primary">Add Brand</h6>
      </div>
      @if($errors->any() )
      <ul>
        @foreach($errors->all() as $error)
      <li class="text-danger">{{$error}}</li>
        @endforeach
      </ul>


      @endif
      <div class="card-body">
        <form action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
         <label for="">Title</label>
         <input type="text" name="title" class="form-control" value="{{old('title')}}">
          </div>
          
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" name="photo">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          </div>

         

          <div class="form-group">


          <select name="status" class="form-control" id="">
              <option value="">Status</option>
              <option value="active" {{old('status')=='active'?'selected':''}}>Active</option>
              <option value="inactive"  {{old('status')=='inactive'?'selected':''}} >Inactive</option>
          </select>
        </div>
         
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
@endsection
@section('scripts')
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
$('#lfm').filemanager('image');
</script>

@endsection