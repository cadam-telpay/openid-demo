# Slim Framework Skeleton Application with Bootstrap 3 and LESS

Based on [Slim-Skeleton](https://github.com/codeguy/Slim-Skeleton) by Josh Lockhart.

Use this skeleton application to quickly setup and start working on a new Slim Framework application.

This application uses the latest Slim and Slim-Views repositories.

It also uses Sensio Labs' [Twig](http://twig.sensiolabs.org) template library, and [Bootstrap 3](http://getbootstrap.com)

## Requirements

[Composer](http://getcomposer.org/)

[node.js](http://nodejs.org/)

[Grunt](http://gruntjs.com)

## Install Composer

If you have not installed Composer, do that now. I prefer to install Composer globally in `/usr/local/bin`, but you may also install Composer locally in your current working directory. For this tutorial, I assume you have installed Composer locally.

<http://getcomposer.org/doc/00-intro.md#installation>

## Install node.js

Visit <http://nodejs.org/> and click the big green "Install" button.

## Install Grunt

`npm install -g grunt-cli`

## Install the Application

After you install Composer, node.js, and Grunt run this command from the directory in which you want to install your new Slim Framework application.

`php composer.phar create-project jswhetstone/slim-skeleton-bootstrap [my-app-name]`

Then CD into your newly created application

`cd [my-app-name]`

And run the following commands

`npm install`

`grunt bootstrap`

Replace `[my-app-name]` with the desired directory name for your new application. You'll want to:
* Point your virtual host document root to your new application's `public/` directory.
* Ensure `logs/` and `templates/cache` are web writeable.

That's it! Now go build something cool.

## Provided Grunt commands

`grunt watch`
Watches the less directory for changes, compiles less when any files in the less directory or subdirectory are modified

`grunt dist`
Compiles all less into minified CSS for distribution

`grunt bootstrap`
Copies all files necessary for Bootstrap to function.
_NOTE: this WILL OVERWRITE all files in `less/bootstrap`, as well as `js/vendor/bootstrap.min.js` and `js/vendor/jquery.min.js`_
_You Should not need to use this command more than once, at the beginning of your project setup_


## How to Contribute

### Pull Requests

1. Fork the jswhetstone/slim-skeleton-bootstrap repository
2. Create a new branch for each feature or improvement
3. Send a pull request from each feature branch to the **develop** branch

It is very important to separate new features or improvements into separate feature branches, and to send a
pull request for each branch. This allows us to review and pull in new features or improvements individually.