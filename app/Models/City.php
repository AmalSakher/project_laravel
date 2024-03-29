<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function users(){
        return $this->hasMany(User::class,'city_id' , 'id');
    }
    use HasFactory;
    public function getActivesStatusAttribute(){
        return $this->active ? 'Active' : 'InActive';

    }
}
