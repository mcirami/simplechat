<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'age',
        'script',
        'keywords',
        'keep_alive',
        'links',
        'images',
        'active'
    ];

    public function users(){
        return $this->belongsTo(User::class);
    }
}
