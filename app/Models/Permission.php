<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
/**
 * Permission object holds details about user rights
 * permission ro can display metadata only
 * permission rd can download file
 */
class Permission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'permission';

    protected $fillable = [
        'file_id',
        'user_id',
        'permission'
    ];
}
