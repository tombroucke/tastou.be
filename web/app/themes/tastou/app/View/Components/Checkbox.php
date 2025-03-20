<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public $name = '';

    public $value = '';

    public $checked = false;

    public $switch = false;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $name, string $value = '', bool $checked = false, bool $switch = false)
    {
        $this->name = $name;
        $this->value = $value;
        $this->checked = $checked;
        $this->switch = $switch;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.checkbox');
    }

    public function id()
    {
        $id = $this->name;
        if ($this->value) {
            $id .= '-'.$this->value;
        }

        return $id;
    }

    /**
     * Element classes
     *
     * @return string
     */
    public function classes()
    {
        $classes = ['form-check'];
        if ($this->switch) {
            $classes[] = 'form-switch';
        }

        return implode(' ', $classes);
    }
}
