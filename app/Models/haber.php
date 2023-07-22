<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ThirdReceipts;

class haber extends Model
{
    use HasFactory;

    protected $fillable = [
        'cuenta',
        'nombre'
    ];

    protected $connection;

    public function construct($con)
    {
        $this->connection = $con;
    }
    public function ThirdReceipts(){
        return $this->hasMany(ThirdReceipts::class, 'id');
    }    
}
