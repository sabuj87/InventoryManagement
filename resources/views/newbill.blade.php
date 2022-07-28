<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Bill</title>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <!-- font-awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <!-- Line awesome -->
   <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/font-awesome-line-awesome/css/all.min.css">
   

</head>
<body>
  <div class="container py-3" >
    <!-- bill find input -->
    <div>
        <form class="" action="{{route('bill')}}" method="get" >
           <div class="d-flex" >
            <input class="form-control  w-25" id="billno" value="{{$billNo}}"  name="billno" placeholder="Bill no"  type="number">
            <input class="btn ms-3 btn-primary" name="submit" value="Find" type="submit">

           </div>
           
        </form>
    </div>
      <!-- bill find input end -->
      <!-- product,customer and date selection -->


      <div class="row mt-3" >
           <div class="col-md-6 pe-3 mt" >
              <select id="addproduct" class="form-select" name="product" >
                <option value="0" >Add Product or Items</option> 
                @foreach($products as $product)
                
                <option value="{{$product->rate}}">{{$product->name}}</option>
                

                @endforeach


              </select>
           </div>
           <div class="col-md-3 px-3 mt" >
            <select class="form-select" id="customer" name="custemer" >
              <option value="0">Select a customer</option>
            
              @foreach($customers as $customer)
              
              <option value="{{$customer->id}}">{{$customer->name}}</option>
              

              @endforeach



            </select>
         </div>
         <div class="col-md-3 px-3 mt" >
          <input id="date" class="form-control" placeholder="Date" type="date">
       </div>

      </div>
      <!-- product,customer and date selection end -->

      
      <!-- data table start -->
      <div class="mt-3" >
        <table id="mainTable" class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Product</th>
              <th>Rate</th>
              <th>Qty</th>
              <th>Total Amount</th>
              <th>Discount (Amt)</th>
              <th>Net Amount</th>
           
             
            </tr>
          </thead>
          <tbody>

           
           

          
           
           
         
          </tbody>
        </table>
      </div>
       <!-- data table end -->

       <div class="float-end d-flex mt-2" >
        <p class="mt-3">Net Total : </p>
        <input id="netTotal" value="0" type="text">
    
      </div>
      <div class="clearfix" ></div>
      <div class="float-end d-flex mt-2 ">
        <p class="mt-3">Discount Total : </p>
        <input  id="discountTotal" value="0" type="text">
    
      </div>
      <div class="clearfix" ></div>
      <div class="float-end d-flex mt-2" >
        <p class="mt-3">Paid Amount : </p>
        <input id="paidAmount" value="0" onkeyup="dueAm()" type="text">
    
      </div>
      <div class="clearfix" ></div>
      <div class="float-end d-flex mt-2" >
        <p class="mt-3">Due Amount : </p>
        <input id="dueAmount"  value="0"  type="text">
    
      </div>
    
      <div class="clearfix" ></div>
      <div class="float-end d-flex mt-2" >
         <button id="savebtn" class="btn btn-primary" >Save changes</button>
    
      </div>
    
        
 

 

 


  </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<!-- jquery cdn -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



  <!-- js -->
  <script>

  

   function totalAmount(qty,rate,id){
    var idili="#"+id+"totalAmount";
 
    var totalAmount = qty.value*rate;
    var idinet="#"+id+"discount";
    $(idinet).text(totalAmount);

    $(idili).text(totalAmount);
    findTotal();
    dueAm()

   }

   function NetAmount(discount,id){
    var idili="#"+id+"totalAmount";
   
    var totalAmount= $(idili).text();
     
    var netamount=totalAmount-discount.value;
    var idinet="#"+id+"discount";
    $(idinet).text(netamount);
    

  
  findTotal();
  findTotald();
  dueAm()
  

   }
    var newId=1;
   $("#addproduct").change(function(){

     var name=$("#addproduct option:selected").text();
     var rate=$("#addproduct").val();
     
     newId++;
    $('#mainTable').append('<tr id='+newId+'><td class=name'+newId+' >'+name+'</td><td class=rate'+newId+' >'+rate+'</td><td><input class=qty'+newId+'  onkeyup="totalAmount(this,'+rate+','+newId+')" type="text" style="width: 70px;"  "></td><td><p id="'+newId+'totalAmount" ></p></td><td><input class="alld discount'+newId+'" onkeyup="NetAmount(this,'+newId+')" type="text" style="width: 70px;""></td><td><p class="all" id="'+newId+'discount" ></p></td></tr>');

   });


   function findTotal(){
    var arr = document.getElementsByClassName('all');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].innerHTML))
            tot += parseInt(arr[i].innerHTML);
    }
    document.getElementById('netTotal').value = tot;
}

function findTotald(){
    var arr = document.getElementsByClassName('alld');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('discountTotal').value = tot;
}

function dueAm(){
  var finalTotal=document.getElementById('netTotal').value;
  var paid= document.getElementById('paidAmount').value;
  var  due=finalTotal-paid;
  
  document.getElementById('dueAmount').value = due;

}

  function productAdd(pname){

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
    var invid=$("#invid").val();
    var productName=pname




    $.post( "{{route('store')}}", { name: "John", time: "2pm" })
  .done(function( data ) {
  
  });


  }
  
  $('#savebtn').click(function(){

    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});




   function inventoryProductSave(){
    var lastRowId = $('#mainTable tr:last').attr("id");
    var billno=$("#billno").val();

var pname = new Array(); 
var quantity = new Array();
var rate= new Array();
var discount= new Array();


if(lastRowId>0){

  for ( var i = 1; i <= lastRowId; i++) {
    pname.push($("#"+i+" .name"+i).html()); 
    quantity.push($("#"+i+" .qty"+i).val()); 
    rate.push($("#"+i+" .rate"+i).html());
    discount.push($("#"+i+" .discount"+i).val());
}
var sendPName = JSON.stringify(pname); 
var sendQuantity = JSON.stringify(quantity); 
var sendRate = JSON.stringify(rate); 
var sendDiscount = JSON.stringify(discount); 

$.post( "{{route('store')}}", { pname: sendPName, quantity: sendQuantity,rate:sendRate,discount:sendDiscount,invid:0,billno:billno})
.done(function( data ) {
alert(data);
}).fail(function(request, status, error) {
//alert(request.responseText);

alert("All field must be filled up")
});
 

}


   }
  
     if($("#netTotal").val()>0){

  saveInvetory();



     }
    function saveInvetory(){

      var billno=$("#billno").val();
      var customerId=$("#customer").val();
      var totalDiscount=$("#discountTotal").val();
      var totalAmount=$("#netTotal").val();
      var paidAmount=$("#paidAmount").val();
      var dueAmount=$("#dueAmount").val();
      var date=$("#date").val();


      $.post( "{{route('storeInv')}}", { billno: billno,customerId:customerId,totalDiscount:totalDiscount,paidAmount:paidAmount,totalAmount:totalAmount,dueAmount:dueAmount,date:date})
  .done(function( data ) {
     alert(data);
    inventoryProductSave();


  }).fail(function(request, status, error) {
alert("All field must be filled up")
    });


    }

   

  
    

  });




  </script>
</body>
</html>