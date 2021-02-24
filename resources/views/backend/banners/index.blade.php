@extends('backend.layouts.master')

@section('content')



<div class="col-lg-12">
  @include('backend.layouts.notify')
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">All Banners</h6>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>S no</th>
              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Condition</th>
              <th>Status</th>
              <th>Action</th>
          
            </tr>
          </thead>
          {{-- <tfoot>
            <tr>

              <th>Image</th>
              <th>Name</th>
              <th>Description</th>
              <th>Condition</th>
              <th>Status</th> 
            </tr>
          </tfoot> --}}
          <tbody>
            @foreach($banners as $key=>$row)
            <tr>
             <td>{{$loop->iteration}}</td>
              <td><img src="{{$row->photo}}" alt="" height="80px" width="80px" alt="banner image"></td>
              <td> {{$row->title}}</td>
              <td>{!!$row->description!!}</td>
              <td>
              @if($row->condition=='banner')
<span class="badge badge-success">Banner</span>
              @else 
              <span class="badge badge-primary">Promo</span>
              @endif

              </td>
              <td>
                <input type="checkbox" name="toggle" value="{{$row->id}}" {{$row->status=='active'?'checked':''}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="xs">
              
              </td>
            
              <td>
                <a href="{{route('banners.edit',$row->id)}}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-edit"></i>
                </a>
                <form action="{{route('banners.destroy',$row->id)}}" method="post" onsubmit="return confirm('Are you sure ?')" style="    display: inline-block;">
                  @csrf 
                  @method('delete')
                  <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fas fa-trash-alt"></i>  </button>
                </form>
              </td>
             
            </tr>
           @endforeach
 
          </tbody>
        </table>
      </div>
    </div>
  </div> 

@endsection
@section('scripts')
<script>
  $('input[name=toggle]').change(function(){
    var mode=$(this).prop('checked');
    var id=$(this).val();
    $.ajax({
      url:"{{route('banner.status')}}",
      type:"post",
      data:{
        _token:'{{csrf_token()}}',
        mode:mode,
        id:id,

      },
      success:function(data){
        alert(data.msg);
      }
    })
    
  })
  </script>    
@endsection