<?php

function is_odd($type='default')
{
    static $even_odd = array(
        'default' => 0
    );
    $even_odd[$type]++;
    return( $even_odd[$type] & 1 );
}

function t($s=null)
{
    $locale_messages = option('locale_messages');
    if (isset($locale_messages[$s])) {
        return $locale_messages[$s];
    } else {
        throw new Exception("i18n error! LANG:". option('current_locale') ." with key:'$s'");
    }
}

function is_current_page($page)
{
    $route = option('route');
    return preg_match($route['pattern'], $page);
}