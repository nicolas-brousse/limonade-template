<?php

require_once APPLICATION_PATH . '/../config/environments/' . APPLICATION_ENV . '.php';

function app_configs()
{
    if (function_exists("env_configs")) {
        $app_after_output = env_configs();
    }
    else {
        throw new Exception("Config file for '". APPLICATION_ENV ."' environment does not exist");
        
    }
}

function app_before($route)
{
    // Default layout
    layout(option('layouts_dir') . '/default.html.php');
}

// function app_after($output, $route)
// {
    
// }
