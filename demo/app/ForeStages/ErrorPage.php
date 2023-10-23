<?php

namespace App\ForeStages;

class ErrorPage
{
    function __construct(){}

    function scf_Default($sv_Url, $sv_Method = '')
    {
        print(file_get_contents(__DIR_ROOT__. '/../pages/ErrorPage.htm'));
    }
}
