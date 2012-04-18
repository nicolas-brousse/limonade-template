<?php

// Include Limonade
require_once 'limonade.php';
require_once 'helpers.php';
require_once 'spyc.php';

ini_set('error_reporting', E_ALL);
ini_set('error_log', APPLICATION_PATH.'/logs/'.APPLICATION_ENV.'.log');

// Auto Include Libraries
require_once 'SplClassLoader.php';

// $classLoader = new SplClassLoader('Pest', APPLICATION_PATH . '/../vendors/pest/lib');
// $classLoader->register();


// Load application configs
require_once_dir(APPLICATION_PATH . '/configs/');


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


    if (option('env') == ENV_DEVELOPMENT) {
        option('debug', true);
    } else {
        option('debug', false);
    }
    app_configs();
}

function before($route)
{
    app_before($route);

    // Locales
    $locale_messages = array();
    $locale = option('current_locale') ? option('current_locale') : option('default_locale');
    $filenames = glob(APPLICATION_PATH . '/locales/' . $locale . '/*.yml');
    if(!is_array($filenames)) $filenames = array();
    foreach($filenames as $filename) {
        $locale_messages = Spyc::YAMLLoad($filename);
    }
    option('locale_messages', $locale_messages);
    option('route', $route);
}

function after($output, $route)
{
    $app_after_output = app_after($output, $route);
    if (!empty($app_after_output)) {
        $output .= $app_after_output;
    }

    if (option('debug') === true) {
        $time = number_format( (float)substr(microtime(), 0, 10) - LIM_START_MICROTIME, 6);
        $output .= "\n<!-- page rendered in $time sec., on ".date(DATE_RFC822)." -->\n";
        $output .= "<!-- for route\n";
        $output .= print_r($route, true);
        $output .= "-->";
        return $output;
    }
}
