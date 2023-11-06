<?php

function cameltoString($string)
{
    return str_replace("_","",preg_replace('/(?<=\\w)(?=[A-Z])/'," $1", $string));
}