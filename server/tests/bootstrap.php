<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 23/07/22
 * Time: 08:12 ص
 */

use Symfony\Component\Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

// ensure a fresh cache when debug mode is disabled
(new Dotenv())->bootEnv(dirname(__DIR__) . '/.env.test');