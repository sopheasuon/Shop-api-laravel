<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = ['city', 'image', 'country'];
    

    public function user()
    {
        return $this->belongsTo(User::class); // foreign key nv na belongTo nv ng
    }

}
