<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OccurrenceSelect extends Component
{
    public $url;

    public $type;

    public $selected;

    public $options;

    /**
     * Create a new component instance.
     */
    public function __construct($url, $type, $selected = '')
    {
        $this->url = $url;
        $this->type = $type;
        $this->selected = $selected;
        $this->options = ['abundant', 'common', 'dominant', 'occasional', 'present', 'rare'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.occurrence-select');
    }
}
