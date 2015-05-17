[![Build Status](https://travis-ci.org/Grummfy/BootstrapVariable2Config.svg)](https://travis-ci.org/Grummfy/BootstrapVariable2Config)

# BootstrapVariable2Config
Convert a variable.less to a config.json file for bootstrap css framework.
The idea is to load the variables.less file and Convert it to a config.json file uploadable on http://getbootstrap.com/customize/

## Convert

### Web server (for local usage only)

Launch it with

    php -S localhost:8000 -t src/
    
And then use your favorite browser and go to http://localhost:8000/web.php and follow the instruction.

### Cli

Launch it with

    php src/cli.php -f "path-to-variables.less" -t less > config.json

## Unit tests
Launch the unit tests with the following command line :

    php vendor/bin/atoum -bf externals/tools/atoum/.bootstrap.atoum.php -d tests/units/

## Notes

Composer should be initialized with :

    composer install

If you don't have composer look at https://getcomposer.org/doc/00-intro.md
