<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InventoryProduct;
use App\Models\customer;

class Inventory extends Model
{
    use HasFactory;

    public function inventoryProducts(){                            
    
        return $this->hasMany(InventoryProduct::class);
  
  
      }

      public function customer(){                            
    
        return $this->belongsTo(customer::class,'customer_id');
  
  
      }
}
