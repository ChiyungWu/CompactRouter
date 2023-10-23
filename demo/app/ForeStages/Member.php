<?php

namespace App\ForeStages;

class Member
{
    private $arr_JsonPost;

    function __construct()
    {
		$this->arr_JsonPost = json_decode(file_get_contents('php://input'), true);
    }

    function scf_ApiCallC($sv_Url, $sv_Method = '')
    {
        $sv_Array = sf_DefaultResponse(true);
        $sv_Array['msg'] = 'SQL: INSERT New Member';
        die(json_encode($sv_Array));
    }

    function scf_ApiCallR1($sv_Url, $sv_Method = '')
    {
        $sv_Array = sf_DefaultResponse(true);
        if(!empty($this->arr_JsonPost['MEB_ID']))
        {
            $sv_Array['msg'] = 'SQL: SELECT Member["'. $this->arr_JsonPost['MEB_ID']. '"]';
        }
        else
        {
            $sv_Array['msg'] = '`MEB_ID` is missed while `R`!!';
        }
        die(json_encode($sv_Array));
    }

    function scf_ApiCallRX($sv_Url, $sv_Method = '')
    {
        $sv_Array = sf_DefaultResponse();
        die(json_encode($sv_Array));
    }

    function scf_ApiCallU($sv_Url, $sv_Method = '')
    {
        $sv_Array = sf_DefaultResponse(true);
        if(!empty($this->arr_JsonPost['MEB_ID']))
        {
            $sv_Array['msg'] = 'SQL: UPDATE Member["'. $this->arr_JsonPost['MEB_ID']. '"]';
        }
        else
        {
            $sv_Array['msg'] = '`MEB_ID` is missed while `R`!!';
        }
        die(json_encode($sv_Array));
    }

    function scf_ApiCallD($sv_Url, $sv_Method = '')
    {
        $sv_Array = sf_DefaultResponse(true);
        if(!empty($this->arr_JsonPost['MEB_ID']))
        {
            $sv_Array['msg'] = 'SQL: DELETE Member["'. $this->arr_JsonPost['MEB_ID']. '"]';
        }
        else
        {
            $sv_Array['msg'] = '`MEB_ID` is missed while `R`!!';
        }
        die(json_encode($sv_Array));
    }
}
