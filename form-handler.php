<?php
if($cs->getRequestValue($cs->getFormRequestName()) == 'submit')
{
    if($cs->dbDataWrite($cs->getRequest()))
    {
        $redirect = $cs->getRedirectString();
        header("Location: $redirect");
        exit;
    }
}
else if($cs->getRequestValue($cs->getFormRequestName()) == 'retry')
    $cs->dbDataWrite($cs->getRequest());
else if($cs->getRequestValue($cs->getFormRequestName()) == 'getdata')
    $dbcs->dbDataEjection($cs->getRequest());
?>