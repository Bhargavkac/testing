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
      <style type="text/css">
         @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');
         .section-products {
         padding: 80px 0 54px;
         }
         .section-products .single-product .part-1 {
         position: relative;
         height: 290px;
         max-height: 290px;
         margin-bottom: 20px;
         overflow: hidden;
         }
         .section-products .single-product .part-1::before {
         position: absolute;
         content: "";
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         z-index: -1;
         transition: all 0.3s;
         }
         .section-products #product-1 .part-1::before {
         background: url("https://i.ibb.co/L8Nrb7p/1.jpg") no-repeat center;
         background-size: cover;
         transition: all 0.3s;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <a href="{{route('all.products')}}" class="btn btn-primary" style="float: right;">All Product</a>
      </div>
      <br> 
      <div class="container">
         <section class="section-products">
            <div class="container">
               <div class="header">
                  <h3>Product Listing</h3>
               </div>
            </div>
            <div class="row">
               @if(count($products) > 0)
               @foreach($products as $product) 
               <div class="col-md-6 col-lg-4 col-xl-3">
                  <div id="product-1" class="single-product">
                     <div class="part-1"> 
                     </div>
                     <div class="part-2">
                        <h3 class="product-title">{{$product->name}}</h3>
                        <p>
                           @foreach($product['Tag'] as $tag_value)
                           {{$tag_value->tag}}, 
                           @endforeach
                        </p>
                        <h4 class="product-old-price">Stock: {{$product->stock}}</h4>
                        <h4 class="product-price">Publish Date: {{Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $product->date)->format('d-m-Y H:i:s')}}</h4>
                     </div>
                  </div>
               </div>
               @endforeach
               @else
               @endif  
            </div>
      </div>
      </section> 
      </div> 
   </body>
</html>