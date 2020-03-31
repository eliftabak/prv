<?php

namespace App;

class ExternalClassesLoader
{

    public function load()
    {

        require_once dirname(__DIR__) . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';

    }
}

$externals = new ExternalClassesLoader();

$externals->load();
