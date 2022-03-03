<?php

namespace App\Models\Categories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];
    
    protected $dates = ['created_at', 'updated_at'];
    
    protected $hidden = ['created_at', 'updated_at'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
