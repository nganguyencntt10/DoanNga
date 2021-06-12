<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';
    protected $fillable = ['secret_key', 'email', 'username', 'password', 'verify_code', 'status', 'created_at', 'updated_at'];


    public function customer_detail() {
        return $this->hasOne(CustomerInfo::class, 'customer_id');
    }
}
