<?php

namespace App\Controllers;

use Sober\Controller\Controller;

use App\Core\Bootstrap_Pagnition;


class Home extends Controller
{
    public static function bootstrap_pagnition($query = null)
    {
        $pagnition = Bootstrap_Pagnition::bootstrap_pagination($query);

        return $pagnition;
    }
}
