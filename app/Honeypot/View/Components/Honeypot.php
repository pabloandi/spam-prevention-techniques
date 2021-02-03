<?php

namespace App\Honeypot\View\Components;

use Illuminate\View\Component;

class Honeypot extends Component
{

    public $fieldName;
    public $fieldTimeName;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fieldName = config('honeypot.field_name');
        $this->fieldTimeName = config('honeypot.field_time_name');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return <<<'blade'
            <div style="display: none;">
                <input type="text" id="{{ $fieldName }}" name="{{ $fieldName }}">
                <input type="text" id="{{ $fieldTimeName }}" name="{{ $fieldTimeName }}" value="{{ microtime(true) }}">
            </div>
        blade;
    }
}
