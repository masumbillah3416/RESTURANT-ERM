<?php

namespace App\View\Components;

use App\Models\setting;
use Illuminate\View\Component;

class webSiteNameComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $setting = setting::find(1);
        return view('components.web-site-name-component',compact('setting'));
    }
}
