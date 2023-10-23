<?php

define('__DIR_ROOT__', __DIR__);

if(0)
{
    define('__BACKSTAGES__', true);
}

if(!defined('__WEB_ROOT__'))
{
    define('__WEB_ROOT__', './');
}





require_once(__DIR_ROOT__. '/../vendor/autoload.php');

if(1)
{
/*
    Only require in demo page.
*/
    require_once(__DIR_ROOT__. '/../../src/CompactRouter.php');
}





define('ACCESS_TIME_FRAME', microtime(true));
define('ACCESS_TIME_START', gmdate('Y-m-d H:i:s', ACCESS_TIME_FRAME).' GMT');

function sf_DefaultResponse($sv_Param = false)
{
    $sv_Array = ['timeframe' => floor(ACCESS_TIME_FRAME)];
    if($sv_Param)
    {
        $sv_Array['timestart'] = ACCESS_TIME_START;
    }
    return($sv_Array);
};

use ChiyungWu\CompactRouter\CompactRouter;
CompactRouter::scf_SetClientPage(['ClientPage1', 'ClientPage2']);
CompactRouter::scf_ParseRoutePath();
if(defined('__BACKSTAGES__'))
{
    CompactRouter::scf_SetNamespace('App\\BackStages\\');
}
else
{
    CompactRouter::scf_SetNamespace('App\\ForeStages\\');
}
CompactRouter::scf_DispatchRoute();
