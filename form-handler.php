<?php

function formHandler()
{
    global $cs;
    $request = $cs->getRequest();

    if($cs->getRequestValue('request_name') == $cs->getFormRequestName())
    {
        $cs->dbDataWrite($request);
    }
    else
        $cs->pinError('Вы заполнили не все поля');

}
