<?php
global $cs;
$server = $_SERVER['HTTP_REFERER'];
if($cs->getRequestValue('request_name') == $cs->getFormRequestName())
{
    if($cs->dbDataWrite($cs->getRequest()))
    {
        $redirect = $cs->getRedirectString();
        header("Location: $server");
        //exit;
    }
    else
    {
        $redirect = $cs->getRedirectString(false);
        header("Location: $server" );
        //exit;
    }
}
?>