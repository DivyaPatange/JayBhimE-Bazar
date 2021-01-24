<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $table = "sub_categories";

    protected $fillable = ['category_id', 'sub_category', 'parent_id', 'status'];
}
