<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pt extends Model
{
    use HasFactory;

    protected $table = 'tbl_pt';

    protected $fillable = ['id_pt', 'nama_pt', 'alamat'];

    public function users()
    {
        return $this->hasMany(User::class, 'id_pt', 'id_pt');
    }
}
