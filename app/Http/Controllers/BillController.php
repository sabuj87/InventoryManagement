<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\InventoryProduct;
use App\Models\customer;
class BillController extends Controller
{
    public function show(Request $request){
        $billNo = $request->billno;
        $inventory  = Inventory::where('bill_no',$billNo)->first();

        $products=Product::orderBy('id','DESC')->get();
        $customers=customer::orderBy('id','DESC')->get();
        if(!is_null($inventory)){
            return  view("bill",['products'=>$products,'customers'=>$customers,'inventory'=>$inventory,'billNo'=>$billNo]);

        }else{
            return  view("newbill",['products'=>$products,'customers'=>$customers,'inventory'=>$inventory,'billNo'=>$billNo]);

        }

    }

    public function  store(Request $request){
     
        $nameArr=json_decode($request->pname);
        $quantityArr=json_decode($request->quantity);
        $rateArr=json_decode($request->rate);
        $discountArr=json_decode($request->discount);
        $invid=$request->invid;
        $billno=$request->billno;
        if(is_null($billno)){

             
            for($i=1;$i<count($nameArr);$i++){
                
              
         
                $pid=Product::where('name',$nameArr[$i])->value('id');
                $ipe=new InventoryProduct;
 
                $ipe->inventory_id=$invid;
                $ipe->product_id=$pid;
                $ipe->rate=$rateArr[$i];
                $ipe->qty=$quantityArr[$i];
                $ipe->discount=$discountArr[$i];
                $ipe->save();
                
 
             
 
             
 
 
        
 
                 
 
             
 
 
             }


             echo "Inventory product saved";

        }else{

            $newInvId=Inventory::where('bill_no',$billno)->value('id');
            for($i=1;$i<count($nameArr);$i++){
                
              
         
                $pid=Product::where('name',$nameArr[$i])->value('id');
                $ipe=new InventoryProduct;
 
                $ipe->inventory_id=$newInvId;
                $ipe->product_id=$pid;
                $ipe->rate=$rateArr[$i];
                $ipe->qty=$quantityArr[$i];
                $ipe->discount=$discountArr[$i];
                $ipe->save();
                
 
             
 
             
 
 
        
 
                 
 
             
 
 
             }


             



        }

        echo " New Innventory product saved";


  
        

          
      






       

        
    }


    public function  storeInv(Request $request){

        $invid=$request->invid;
        $billno=$request->billno;
        $customerId=$request->customerId;
        $totalDiscount=$request->totalDiscount;
        $totalAmount=$request->totalAmount;
        $dueAmount=$request->dueAmount;
        $paidAmount=$request->paidAmount;
        $date=$request->date;

        if(!is_null($invid)){

            
        $inventory  = Inventory::find($invid);
            if(!is_null($inventory)){
                $inventory->date=$date;
                $inventory->bill_no=$billno;
                $inventory->customer_id =$customerId;
                $inventory->total_discount=$totalDiscount;
                $inventory->total_bill_amount=$totalAmount;
                $inventory->due_amount=$dueAmount;
                $inventory->paid_amount=$paidAmount;
       
                $inventory->save();
                echo "Inventory updated";
              
             }

           
        }else{

            $inventory =  new Inventory;
            $inventory->date=$date;
                $inventory->bill_no=$billno;
                $inventory->customer_id =$customerId;
                $inventory->total_discount=$totalDiscount;
                $inventory->total_bill_amount=$totalAmount;
                $inventory->due_amount=$dueAmount;
                $inventory->paid_amount=$paidAmount;

                $inventory->save();

                echo " New Inventory created";


            
        }

       

        
      
      

      
      

    }




   
}
