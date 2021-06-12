<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bookingvip extends Model
{
    use HasFactory;
    protected $table = 'bookingvip';
    protected $fillable = ['customer_id', 'time_set', 'time', 'services_id', 'prices', 'status', 'created_at', 'updated_at'];

    
    public function customer() {
        return $this->belongsTo(Customer::class);
    }
}
