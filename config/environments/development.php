<?php

function env_configs()
{
    // App defaults configs
    if ( !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1','::1')) ) {
        option('base_uri', '/');
    }
    else {
        option('base_uri', '/my-project/path/public/');//keep last /public
    }

    option('encoding', 'utf-8');
    option('session', 'app_fid');
    // option('default_locale', 'fr');

    # DB
    // option('db_dsn', 'mysql:host=my-hostname;dbname=my-dbname');
    // option('db_user', '');
    // option('db_pass', '');
    
}
