<?php

namespace Udjat;

/**
 * 
 */
class Config
{

    public $rpxApiKey = null;

    /**
     * @param string $filename
     * @return void
     */
    public function load($filename)
    {
        if (file_exists($filename)) {

            $data = include $filename;

            foreach ($data as $key => $value) {

                $this->{$key} = $value;
            }

        } else {

        }
    }
}
