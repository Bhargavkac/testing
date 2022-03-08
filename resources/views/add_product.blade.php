<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Interview</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
      <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"/>
      <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet"/>
      <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
      <style type="text/css">
         .bootstrap-tagsinput { 
         width: 100%;
         }
      </style>
   </head>
   <body>
      <div class="container">
         <h2>Add Product</h2>
         <form action="{{route('store.product')}}"  method="POST">
            @CSRF
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group">
                     <label>Product Name:</label>
                     <input type="text" class="form-control" placeholder="Enter Product Name" name="name" value="{{old('name')}}">
                     @error('name')
                     <p style="color: red;">{{ $message }}</p>
                     @enderror
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label>Publish date:</label> 
                     <div class='input-group date' id='datetimepicker'>
                        <input type='text' class="form-control" name="date" value="{{old('date')}}" />
                        <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                     </div>
                     @error('date')
                     <p style="color: red;">{{ $message }}</p>
                     @enderror
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-sm-6">
                  <div class="form-group">
                     <label>Tags:</label> 
                     <input id="tagsinput" type="text" name="tags" data-role="tagsinput" class="form-control" value="{{old('tags')}}"  />
                     <p id="tags_error" style="color: red;display:none;">There should be at least one tag.</p>
                  </div>
               </div>
               <div class="col-sm-6">
                  <div class="form-group">
                     <label>Stock:</label> 
                     <input  type="number" name="stock" min="0"  class="form-control" placeholder="Enter Stock Count" value="{{old('stock')}}" /> 
                     @error('stock')
                     <p style="color: red;">{{ $message }}</p>
                     @enderror 
                  </div>
               </div>
            </div>
            <button type="submit" id="submit-form" style="display: none;"></button>
         </form>
         <button id="submit-button" class="btn btn-primary">Submit</button>
      </div>
      <script type="text/javascript">
         $(function () {
             $('#datetimepicker').datetimepicker({
                format:'DD-MM-YYYY HH:mm:ss'
             });
         });
         $('#submit-button').on('click',function(){
            if($('#tagsinput').val() == ''){
              $('#tags_error').show();
              return false;
            }else{
               $('#tags_error').hide();
               $('#submit-form').click();
            }
         });
      </script> 
   </body>
</html>