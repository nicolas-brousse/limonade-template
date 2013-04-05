<?php

function env_configs()
{
    // App defaults configs
    if ( !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) ) {
        option('base_uri', '/');
    }
    else {
        option('base_uri', '/my-project/path/');
    }

    option('encoding', 'utf-8');
    option('session', 'app_fid');
    // option('default_locale', 'fr');
}
