<?php
if($cs->getRequestValue($cs->getFormRequestName()) == 'submit')
{
    //@TODO - Требуется переосмысление мути со сбором ссылки редиректа
    if($cs->dbDataWrite($cs->getRequest()))
    {
        $redirect = $cs->getRedirectString();
        header("Location: $redirect");
        exit;
    }
}
else
    $cs->dbDataWrite($cs->getRequest());
?>