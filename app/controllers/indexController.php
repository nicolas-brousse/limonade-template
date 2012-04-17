<?php

function indexAction()
{
    set('page_title', "Home");
    set('text', 'welcome');
    return html('index/index.html.php');
}
