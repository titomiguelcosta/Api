<?php

$env = getenv('env') ? : 'dev';

require_once __DIR__.'/../app/env/'.$env.'.php';
