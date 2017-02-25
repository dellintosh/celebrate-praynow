<?php
/**
 * This file can be used to set parameters on $container
 * which will be reflected in our running Symfony application.
 */

$container->setParameter('log_level', getenv('LOG_LEVEL'));
