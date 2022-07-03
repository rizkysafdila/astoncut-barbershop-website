<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['service', 'stylist'];
    
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function stylist()
    {
        return $this->belongsTo(Stylist::class);
    }
}
