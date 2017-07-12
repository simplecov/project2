<?php
global $cs;
if($cs->getRequestValue('request_name') == $cs->getFormRequestName())
{
    if($cs->dbDataWrite($cs->getRequest()))
    {
        $redirect = $cs->getRedirectString();
        header("Location: $redirect");
        exit;
    }
//    else
//    {
//        $redirect = $cs->getRedirectString(false);
////        echo $redirect;
////        $cs->bug($_SERVER);
////        $cs->bug($_REQUEST);
////        exit;
//        header("Location: $redirect" );
//        exit;
//    }
}
?>