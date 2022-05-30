<?php

exec('bin/console lexik:jwt:generate-keypair --skip-if-exists');

exec('cp app_crontab /etc/cron.d/app_crontab');
exec('crontab /etc/cron.d/app_crontab');
exec( 'service cron restart');

exec('php-fpm');
