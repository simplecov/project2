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
else
    $cs->dbDataWrite($cs->getRequest());
?>