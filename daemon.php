#!/usr/bin/env php
<?php

include __DIR__ . '/autoloader.php';

Service\Daemon::init(include(__DIR__ . '/config.php'))->run();
