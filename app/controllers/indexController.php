<?php

/**
 * Index Action
 */
function indexIndexAction()
{
    set('page_title', "Home");
    if (params('name')) {
        flash("info", "Welcome to ".params("name"));
        set('name', params('name'));
    }
    return html('index/index.html.php');
}

/**
 * About Action
 */
function aboutIndexAction()
{
    set('page_title', "About");
    return html('index/about.html.php');
}
