<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ThirdReceipts;

class elaborado extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'estado'
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
