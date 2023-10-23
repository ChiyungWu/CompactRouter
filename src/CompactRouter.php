<?php

namespace ChiyungWu\CompactRouter;

class CompactRouter
{
    private static $str_Namespace;
    private static $str_RoutePath;

    private static $arr_ClientPage;
    private static $arr_RouteParam =
        ['UrlClass' => null
        ,'UrlMethod' => null
        ];

    function __construct(){}

    static function scf_GetRoutePath()
    {
        return(self::$str_RoutePath);
    }

    static function scf_SetClientPage($sv_ArrayParam)
    {
        self::$arr_ClientPage = array_map('strtolower', $sv_ArrayParam);
    }

    static function scf_SetNamespace($sv_Param)
    {
        self::$str_Namespace = $sv_Param;
    }

    static function scf_ParseConsoleParam($sv_ArrayParam)
    {
        parse_str(implode('&', array_slice($sv_ArrayParam, 2)), $_GET);
    }

    static function scf_ParseRoutePath()
    {
        if(!empty($_SERVER['REQUEST_METHOD']))
        {
            self::$str_RoutePath = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '/';
        }
        else
        {
            $_SERVER['argv'] = isset($_SERVER['argv']) ? $_SERVER['argv'] : [];
            self::scf_ParseConsoleParam($_SERVER['argv']);
            self::$str_RoutePath = isset($_SERVER['argv'][1]) ? $_SERVER['argv'][1] : '/';
        }
        self::$str_RoutePath = urldecode(trim(self::$str_RoutePath));
        if('/' != substr(self::$str_RoutePath, -1))
        {
            self::$str_RoutePath .= '/';
        }
    }

    static function scf_SetRouteParamValue($qv)
    {
        if(preg_match_all('`'. $qv. '`i', self::$str_RoutePath, $sv_PregMatch))
        {
            self::$arr_RouteParam['UrlClass'] = implode('\\', array_map('ucfirst', explode('-', $sv_PregMatch[1][0])));
            self::$arr_RouteParam['UrlMethod'] = isset($sv_PregMatch[2][0]) ? $sv_PregMatch[2][0] : null;
            return(true);
        }
    }

    static function scf_DispatchRoute()
    {
        if('/' === self::$str_RoutePath)
        {
            self::$arr_RouteParam['UrlClass'] = 'Homepage';
            self::scf_ExecuteRouting('/Homepage/');
            return;
        }
        if('/api/' === self::$str_RoutePath)
        {
            die(json_encode(sf_DefaultResponse()));
        }

        $sv_RouteRules =
            ['/api/C/([^\/]+)/([^\/]*)/*'
            ,'/api/R1/([^\/]+)/([^\/]*)/*'
            ,'/api/RX/([^\/]+)/([^\/]*)/*'
            ,'/api/U/([^\/]+)/([^\/]*)/*'
            ,'/api/D/([^\/]+)/([^\/]*)/*'
            ,'/api/S/([^\/]+)/([^\/]*)/*'
            ,'/([^\/]+)/([^\/]*)/*'
            ];
        foreach($sv_RouteRules as $qv)
        {
            if(self::scf_SetRouteParamValue($qv))
            {
                self::scf_ExecuteRouting($qv);
                return;
            }
        }
        die('You should never be here!!');
    }

    static function scf_ExecuteRouting($qv)
    {
        if(in_array(strtolower(self::$arr_RouteParam['UrlClass'] ?: ''), self::$arr_ClientPage))
        {
            self::$arr_RouteParam['UrlClass'] = 'ClientPage';
        }
        $sv_ClassName = self::$str_Namespace. self::$arr_RouteParam['UrlClass'];
        if(0)
        {
            die($sv_ClassName);
        }

        if(!class_exists($sv_ClassName))
        {
            if(str_starts_with(self::$str_RoutePath, '/api/'))
            {
                die(json_encode(sf_DefaultResponse()));
            }
            else
            {
                $sv_ClassName = self::$str_Namespace. 'ErrorPage';
            }
        }

        $sv_String = substr($qv, 1, 6);
        switch($sv_String)
        {
            case 'api/C/':
                $sv_Method = 'scf_ApiCallC';
                break;

            case 'api/R1':
                $sv_Method = 'scf_ApiCallR1';
                break;

            case 'api/RX':
                $sv_Method = 'scf_ApiCallRX';
                break;

            case 'api/U/':
                $sv_Method = 'scf_ApiCallU';
                break;

            case 'api/D/':
                $sv_Method = 'scf_ApiCallD';
                break;

            case 'api/S/':
                $sv_Method = 'scf_ApiCallS';
                break;

            default:
                $sv_Method = 'scf_Default';
                break;
        }

        $sv_Instance = new ($sv_ClassName);
        if(method_exists($sv_ClassName, $sv_Method))
        {
            $sv_Instance->$sv_Method(self::$str_RoutePath, self::$arr_RouteParam['UrlMethod']);
            return;
        }
        die('Miss Method: '. $sv_ClassName. '{}@'. $sv_Method. '()');
    }
}
