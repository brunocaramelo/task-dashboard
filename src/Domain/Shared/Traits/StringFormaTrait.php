<?php

namespace Src\Application\Shared\Traits;

trait StringFormaTrait
{

    protected function formatUrlParams($params) : string
    {
        $data = '';
        foreach ($params as $key => $param) {
            $data .= $key.'='.$param;
        }
        return empty($params) ? '' : '&'.$data;
    }
}
