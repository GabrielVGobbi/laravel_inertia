<?php

namespace App\View\Components;

use App\Permissions\Models\Menu;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Component;

class Menus extends Component
{
    private $group;

    public function __construct()
    {
        $group = request()->segment(2);
        $this->group = in_array($group, config('painel.modules'))  ? $group : 'base';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        $menus = Menu::whereIn('group', [$this->group, 'group'])->whereNull('sub_menu')->orderBy('order')->get();

        #$layout = auth()->user()->settings('data_layout');

        return view('components.menus', [
            'menus' => $menus,
            #'layout' => $layout,
        ]);
    }
}
