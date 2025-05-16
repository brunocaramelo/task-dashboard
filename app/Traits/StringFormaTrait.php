<?php

namespace App\Traits;

trait StringFormaTrait
{

    protected function formatUrlParams($params)
    {
        $data = '';
        foreach ($params as $key => $param) {
            $data .= $key.'='.$param;
        }
        return empty($params) ? '' : '&'.$data;
    }
}