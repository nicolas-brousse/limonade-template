<?php

/**
 * IndexController
 */
dispatch('/', 'indexIndexAction');
dispatch('/hello/:name', 'indexIndexAction');
dispatch('/about', 'aboutIndexAction');
