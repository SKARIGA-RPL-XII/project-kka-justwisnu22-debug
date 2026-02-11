<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMaterialProgress extends Model
{
    protected $table = 'user_material_progress';
    
    protected $fillable = [
        'user_id',
        'material_id',
        'exp_claimed_at'
    ];
    
    protected $casts = [
        'exp_claimed_at' => 'datetime'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
