### Requirements
- Git
- Docker-compose

### How to launch the project?

Please do the following:
- Create the env file(`.env`) based on `.env.dist`
- Run `docker-compose up -d`
- Run from under php container:
  - `bin/console doctrine:schema:create`
  - `bin/console doctrine:fixtures:load`
  - `bin/console --env=test doctrine:database:create`
  - `bin/console --env=test doctrine:schema:create`
  - `bin/phpunit`
  - `bin/console messenger:consume async` - start MQ

### Services

- Rabbitmq Management - http://localhost:15672/
- MailHog Management - http://localhost:8025/
- API doc - http://localhost/api
- Postgres - sunfinance:sunfinance@postgres:5432
- User credential - johndoe@example.com:apassword



