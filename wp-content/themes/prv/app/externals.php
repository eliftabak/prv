<?php

namespace App;

class ExternalClasses
{

    public function __construct()
    {

        require_once dirname(__DIR__) . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
    }
}

$externals = new ExternalClasses();
