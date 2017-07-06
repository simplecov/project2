<?php

$cs = new \Simplecov\CounterScore();

$request = $cs->getRequest();

$cs->bug($request);