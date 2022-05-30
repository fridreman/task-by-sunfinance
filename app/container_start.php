<?php

exec('bin/console lexik:jwt:generate-keypair --skip-if-exists');

exec('php-fpm');
