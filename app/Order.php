<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //    public function item()
    //    {
    //        return $this->hasOne('App\Item', 'foreign_key', 'local_key');
    //
    //    }

    /**
     *自訂table 
     */
    protected $table= 'orders'; 
}
