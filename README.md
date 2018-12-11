# firestone_locator
=================

Location Mapper for Firestone Library

Current Requirements
1. PHP < 5.6 (Currently)
2. Maridb/Mysql

## Local Development

A .lando.yml file is provided - You will need to install Lando: https://docs.devwithlando.io/.

### Setup steps
1. ```git clone git@github.com:pulibrary/firestone_locator.git```
2. ```cd firestone_locator```
3. Start up app lando ``lando start```
4. Create and seed the staging and production databases
```lando db-import locator.seed.sql.gz --host database```
```lando db-import locator.seed.sql.gz --host database1```
5. Create a db config for your current environment
```cd includes```
```cp db_lando_config.php db_config.php```
6. Note the the localhost http port the lando app is running on.
```lando info```
7. In db_config.php set the value of BASE_URL to that value with a trailing slash. Should be something like
```http://localhost:32807/```
8. Application route will be http://localhost:32807/
9. Admin route will be http://localhost:32807/admin.
