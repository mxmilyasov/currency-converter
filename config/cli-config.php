<?php

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require APP_ROOT . '/config/bootstrap.php';

return ConsoleRunner::createHelperSet($em);
