<?php
if($cs->getRequestValue('request_name') == $cs->getFormRequestName())
{
    //@TODO - Требуется переосмысление мути со сбором ссылки редиректа
    if($cs->dbDataWrite($cs->getRequest()))
    {
//        $redirect = $cs->getRedirectString();
//        header("Location: $redirect");
//        exit;
        $cs->setRequest([$cs->getFormRequestName() => 'y']);
    }
//    else
//    {
//        $redirect = $cs->getRedirectString(false);
//        echo $redirect;
//        $cs->bug($_SERVER);
//        $cs->bug($_REQUEST);
//        exit;
//        header("Location: $redirect" );
//        exit;
//    }
}
?>