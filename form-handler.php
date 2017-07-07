<?php
global $cs;
$request = $cs->getRequest();
//$cs->bug($request);

if(is_array($request))
{
    $cs->dbDataWrite($request);
}
else
    $cs->pinError('Вы заполнили не все поля');