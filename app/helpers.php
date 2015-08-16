<?php

/**
 * Help in setting the class of the active link to 'active'
 * If another class is required,
 * pass a third parameter of class name
 * @param $path
 * @param string $secondPath
 * @param string $active
 * @return string
 */
    function set_active($path, $secondPath = '', $active = 'active')
    {
        if($path == 'admin/search'&& strpos(Request::path(),'admin/search') !== false)
        {
            return $active;
        }
        return (Request::is($path) || Request::is($secondPath)) ? $active : '';
    }
