<?php
require("vendor/autoload.php");

$openapi = \OpenApi\Generator::scan(['Http/Controllers']);

header('Content-Type: application/x-yaml');
echo $openapi->toYaml();