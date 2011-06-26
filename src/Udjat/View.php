<?php

namespace Udjat;

/**
 * 
 */
class View
{

    /**
     * @param string $template
     * @return void
     */
    public function render($template)
    {
        $cacheBuster = rand(100000,999999); // @todo dummy cachebuster for now

        include
            ROOT_PATH . DIRECTORY_SEPARATOR
            . 'view' . DIRECTORY_SEPARATOR
            . $template;
    }
}
