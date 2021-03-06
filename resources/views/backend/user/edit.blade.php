@extends('backend.layouts.master')
@section('content')
<div class="col-lg-8 ">
    <!-- Form Basic -->
    <div class="card mb-4">
      @include('backend.layouts.notify')
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
      
        <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
      </div>
      @if($errors->any() )
      <ul>
        @foreach($errors->all() as $error)
      <li class="text-danger">{{$error}}</li>
        @endforeach
      </ul>


      @endif
      <div class="card-body">
        <form action="{{route('user.update',$user->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="form-group">
         <label for="">Name</label>
         <input type="text" name="full_name" class="form-control" value="{{$user->full_name}}">
          </div>
          <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" value="{{$user->username}}">
          </div>
          <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" class="form-control" value="{{$user->email}}">
          </div>
        
          <div class="form-group">
            <label for="">Mobile</label>
            <input type="number" name="phone" class="form-control" value="{{$user->phone}}">
          </div>
          <div class="form-group">
            <label for="">Address</label>
            <textarea name="address" class="form-control" id="" cols="30" rows="5">{{$user->address}}</textarea>
          </div>
          <div class="form-group">
            <div class="input-group">
                <span class="input-group-btn">
                  <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Choose
                  </a>
                </span>
                <input id="thumbnail" class="form-control" type="text" value="{{$user->photo}}" name="photo">
              </div>
              <div id="holder" style="margin-top:15px;max-height:100px;"></div>
          </div>

          <div class="form-group">


            <select name="role" class="form-control" id="" required>
                <option value="">Choose Role</option>
                <option value="admin" {{$user->role=='admin'?'selected':''}}>Admin</option>
                <option value="vendor" {{$user->role=='vendor'?'selected':''}}>Vendor</option>
                <option value="customer" {{$user->role=='customer'?'selected':''}}>Customer</option>
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