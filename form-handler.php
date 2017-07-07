<?php

global $cs;
$request = $cs->getRequest();

if($cs->getRequestValue('request_name') == $cs->getFormRequestName())
{
    if($cs->dbDataWrite($request))
    {
        $redirect = $cs->getRedirectString();
        header("Location: $redirect");
        exit;
    }
}