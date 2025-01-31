<?php

use Kirby\Cms\Page;

/**
 * @method object date()
 * @method object text()
 */
class ScribblePage extends Page
{
    /**
     * @param array|string|null $options
     */
    public function url($options = null): string
    {
        $date = $this->date()->toDate('Y/m/d-Hi');
        return '/scribbles/' . $date;
    }
}
