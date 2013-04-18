<?php

use Symfony\Component\Yaml\Parser;

// Load vendors
require_once APPLICATION_PATH . '/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set('error_log', APPLICATION_PATH.'/logs/'.APPLICATION_ENV.'.log');


// Load application configs
require_once_dir(APPLICATION_PATH . '/../config/');
require_once_dir(APPLICATION_PATH . '/helpers/');


//Configuration de limonade
function configure()
{
    option('root_dir', APPLICATION_PATH);
    option('env', APPLICATION_ENV === 'production' ? ENV_PRODUCTION : ENV_DEVELOPMENT);
    option('public_dir', APPLICATION_PATH . '/../public');
    option('views_dir', APPLICATION_PATH . '/views');
    option('controllers_dir', APPLICATION_PATH . '/controllers');
    option('layouts_dir', 'layouts');
    option('default_locale', 'en');
    option('current_locale', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));
    option('locale_messages', array());

    require_once_dir(APPLICATION_PATH . '/../app/models');

    if (option('env') == ENV_DEVELOPMENT) {
        option('debug', true);
    } else {
        option('debug', false);
    }
    app_configs();
}

function before($route)
{
    if (function_exists("app_before")) {
        app_before($route);
    }

    // Locales
    $yaml            = new Parser();
    $locale_messages = array();
    $locale          = option('current_locale') ? option('current_locale') : option('default_locale');
    $filenames       = glob(APPLICATION_PATH . '/locales/' . $locale . '/*.yml');

    if (! is_array($filenames)) {
        $filenames = array();
    }

    foreach($filenames as $filename) {
        $locale_messages = $yaml->parse(file_get_contents($filename));
    }
    option('locale_messages', $locale_messages);
    option('route', $route);
}

function after($output, $route)
{
    if (function_exists("app_after")) {
        $app_after_output = app_after($output, $route);
    }
    if (!empty($app_after_output)) {
        $output .= $app_after_output;
    }

    if (option('debug') === true) {
        $time = number_format( (float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
        $output .= "\n<!-- page rendered in $time sec., on ".date(DATE_RFC822)." -->\n";
        $output .= "<!-- for route\n";
        $output .= print_r($route, true);
        $output .= "-->";
    }
    
    return $output;
}
