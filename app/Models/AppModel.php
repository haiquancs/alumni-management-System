<?php
/**
 * Created by PhpSublimeText.
 * User: Tam Support
 * Date: 7/10/2018
 * Time: 5:00 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AppModel extends Authenticatable
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];


}