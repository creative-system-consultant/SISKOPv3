<?php

function cameltoString($string)
{
    return preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $string);
}