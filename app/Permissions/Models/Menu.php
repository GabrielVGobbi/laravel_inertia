<?php

namespace App\Permissions\Models;

use App\Traits\SlugTrait;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'route',
        'icon',
        #'permission',
        'collapse',
        'group',
        'sub_menu',
    ];

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'sub_menu', 'id');
    }
}
