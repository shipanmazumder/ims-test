<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['category_name',"deleted_at","created_at","updated_at"];

    public function products()
    {
        return $this->hasMany(MasterProduct::class);
    }
}
