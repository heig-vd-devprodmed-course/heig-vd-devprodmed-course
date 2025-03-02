<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voiture extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'marque', 'type', 'couleur', 'cylindree', 'user_id' 
    ];
    
    protected $table='voitures';
    public $timestamps=false;
    
    public function user() {
        return $this->belongsTo(User::class);            // Relation 1(:N)
    }
}
