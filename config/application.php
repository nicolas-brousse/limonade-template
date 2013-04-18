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

    if(option('db_dsn'))
    {
        try
        {
            $db = new PDO(option('db_dsn'), option('db_user'), option('db_pass'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        catch (Exception $e)
        {
            halt('Connexion failed: ' . $e); # raises an error / renders the error page and exit.
        }

        option('db', $db);
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
