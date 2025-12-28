<?php

require_once('vendor/autoload.php');
require_once('config/config.php');

header('Access-Control-Allow-Origin: ' . $config["application"]["allowed_origin"]);
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once('router.php');