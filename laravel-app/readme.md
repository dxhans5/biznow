<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Installing the Application

This application runs in a local docker instance using [docker-compose-laravel](https://github.com/aschmelyun/docker-compose-laravel). To build and run the docker instance, use the following command in a CLI:
```docker-compose build && docker-compose up -d```

Once the docker instance has been built and run, you can access the application at http://host.docker.internal:8080

A default user has already been implemented into the login form for ease of use, however testing of authentication can be achieved by changing this email or password.

## Running Tests

Once the application has been installed and running, you can run all PHPUnit tests from a CLI by using the following command:
```docker-compose exec app php ./vendor/bin/phpunit```

Note: In my case while using Windows, in order to access the docker instance via a command line, I was required to prepend 'winpty' before the line above. The full command in that instance is:
```winpty docker-compose exec app php ./vendor/bin/phpunit```

Thank you so much for this opportunity...and I look forward to hearing from you!
