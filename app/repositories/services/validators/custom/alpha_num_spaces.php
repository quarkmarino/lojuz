<?php

/*
* app/validators/alpha_spaces.php
*/

Validator::extend('alpha_num_spaces', function($attribute, $value)
{
    return preg_match('/^[\pL\pN\s]+$/u', $value);
});