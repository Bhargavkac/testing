<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Interview</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   </head>
   <body>
      <div class="container">
         <a href="{{route('add.product')}}" class="btn btn-primary" style="float: right;">Add Product</a>
      </div>
      <br>
      <div class="container">
         @if(session()->has('message'))
         <div class="alert alert-success" id="success-div">
            {{ session()->get('message') }}
         </div>
         @endif 
      </div>
      <meta name="_token" content="{{csrf_token()}}" />
      <div class="container">
         <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
               <tr>
                  <th>Product Name</th>
                  <th>Tags</th>
                  <th>Publish date </th>
                  <th>Available Stock Count</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               @if(count($products) > 0)
               @foreach($products as $product)
               <tr>
                  <td>{{$product->name}}</td>
                  <td>
                     @foreach($product['Tag'] as $tag_value)
                     {{$tag_value->tag}}, 
                     @endforeach
                  </td>
                  <td>{{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->date)->format('d-m-Y H:i:s')}}</td>
                  <td>{{$product->stock}}</td>
                  <td><a href="{{route('edit.product',$product->id)}}" class="btn btn-warning">Edit</a>
                     <button type="button" class="btn btn-danger delete-button" data-id="{{$product->id}}">Delete</button>
                  </td>
               </tr>
               @endforeach
               @else
               <tr>
                  <td colspan="5" style="text-align: center;">No Data Found.</td>
               </tr>
               @endif  
            </tbody>
            <tfoot>
               <tr>
                  <th>Product Name</th>
                  <th>Tags</th>
                  <th>Publish date </th>
                  <th>Available Stock Count</th>
                  <th>Action</th>
               </tr>
            </tfoot>
         </table>
         <a href="{{route('product.listing')}}" class="btn btn-primary" style="float: right;">Product Listing</a>
      </div>
      <script type="text/javascript">
         $(document).ready(function() {
             $('#example').DataTable();
         } );
         $('.delete-button').on('click',function(){
             var product_id = $(this).data('id'); 
             var confirmation = confirm('Are you sure you want to delete this Product?');
             if(confirmation){ 
                    $.ajaxSetup({
                       headers: {
                           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                       }
                   });    
                 $.ajax({
                   url: "{{ url('/delete-product') }}",
                   method: 'post',
                   data: {
                      product_id: product_id
                   },
                   success: function(result){ 
                     location.reload();    
                      alert('Document Deleted Successfully.');
                   }
                 });
             }
         });
         setTimeout(function(){
           $('#success-div').remove();
         }, 5000); 
         
      </script>
   </body>
</html>