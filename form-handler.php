<?php

$cs = new \Simplecov\CounterScore();
$request = $cs->getRequest();
$errors = array();

if(is_array($request))
{

}
else
    $cs->pinError('Вы заполнили не все поля');

if(count($cs->getErrors()) > 0)
{

}
else
{

}
