<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = "brands";

    protected $fillable = ['parent_sub_category', 'sub_category', 'child_sub_category', 'brand_name', 'status'];
}
