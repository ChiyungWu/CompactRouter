<?php

namespace App\BackStages;

class ClientPage
{
    function __construct(){}

    function scf_Default($sv_Url, $sv_Method = '')
    {
        print(file_get_contents(__DIR_ROOT__. '/../pages/ClientPage.htm'));
    }
}
