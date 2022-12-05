# firestone_locator
=================

Location Mapper for Firestone Library

Current Requirements
1. PHP 8.1
2. Maridb/Mysql

## Local Development

A .lando.yml file is provided - You will need to install Lando: https://docs.devwithlando.io/.

### Setup steps
1. ```git clone git@github.com:pulibrary/firestone_locator.git```
2. ```cd firestone_locator```
3. Start up app lando ```lando start``` (make sure Docker is running)
4. Create and seed the staging and production databases
   - ```gzip -d locator.seed.sql.gz```
   - ```lando db-import locator.seed.sql --host database```
   - ```lando mysql locator_stage```
   - In mysql shell type ```SET autocommit=0 ; source locator.seed.sql ; COMMIT ;```
5. Create a db config for your current environment
   - ```cd includes```
   - ```cp db_lando_config.php db_config.php```
6. Note the the localhost http port the lando app is running on via
```lando info```
7. In `includes/db_config.php` set the value of BASE_URL to that value with a trailing slash. Should be something like
```http://localhost:32807/```
8. Application route will be http://localhost:32807/
9. Admin route will be http://localhost:32807/admin.
10. Add current map image set. Currently needs to be manually pulled from production application. Locate images in ```images/production/f``` and ```images/stage/f```.

## Unit Tests

### Caveats
1. they take a fairly long time to run
1. they are by no means complete

Tests use phpunit https://phpunit.de/manual/current/en/index.html

### To Run

1. Run the tests on the lando server by running `lando test`

### To Run a single test

1. Note the name of the file that contains your test and the method that actually contains your assertions.
1. `lando php phpunit-8.phar --filter methodName tests/FileName.php`

For example, if you want to run the `testLinks` method in the `CompareProdTest` class in the `CompareProdTest.php` file, you would run:

```
lando php phpunit-8.phar --filter testLinks tests/CompareProdTest.php
```

## Deploy to server

We have capistrano set up to deploy our servers
 1. `cap staging deploy` will deploy the main branch to staging
 1. `BRANCH=other cap staging deploy` will deploy the other branch to staging

   `cap -T` gives you a list of commands that can be run
