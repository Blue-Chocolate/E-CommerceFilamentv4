<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * (Optional — Laravel will infer "customers" automatically)
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
}
