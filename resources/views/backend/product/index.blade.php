@extends('backend.layouts.master')

@section('content')



<div class="col-lg-12">
  @include('backend.layouts.notify')
    <div class="card mb-4">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">All Product ({{\App\Models\Product::count()}})</h6>
        <a href="{{route('product.create')}}" class="btn btn-warning">Create Product</a>
      </div>
      <div class="table-responsive p-3">
        <table class="table align-items-center table-flush table-hover" id="dataTableHover">
          <thead class="thead-light">
            <tr>
              <th>S no</th>
              <th>Image</th>
              <th>Name</th>
               <th>Price</th>
               <th>Discount</th>
               <th>Size</th>
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
            @foreach($product as $key=>$row)
            @php 
$photo=explode(',',$row->photo)
            @endphp
            <tr>
             <td>{{$loop->iteration}}</td>
              <td><img src="{{$photo[0]}}" alt="" height="80px" width="80px" alt="banner image"></td>
              <td> {{$row->title}}</td>
             
              <td>
  {{number_format($row->price,2)}}

              </td>
              <td>
                {{$row->discount}}%
              </td>
              <td>
                {{$row->size}}
              </td>
              <td>
                @if($row->condition=='new')
                <span class="badge badge-success">{{$row->condition}}</span>
              @elseif($row->condition=='hot')
              <span class="badge badge-danger">{{$row->condition}}</span>
              @elseif($row->condition=='popular')
              <span class="badge badge-warning">{{$row->condition}}</span>
              @endif
              </td>
              <td>
                <input type="checkbox" name="toggle" value="{{$row->id}}" {{$row->status=='active'?'checked':''}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger" data-size="xs">
              
              </td>
            
              <td>
                <a href="{{route('product.edit',$row->id)}}" class="btn btn-warning btn-sm float-left" title="Edit"><i class="fas fa-edit"></i>
                </a>
                <form action="{{route('product.destroy',$row->id)}}" class="float-left ml-1" method="post" onsubmit="return confirm('Are you sure ?')" >
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
      url:"{{route('product.status')}}",
      type:"post",
      data:{
        _token:'{{csrf_token()}}',
        mode:mode,
        id:id,

      },
      success:function(data){
        // alert(data.msg);
      }
    })
    
  })
  </script>    
@endsection