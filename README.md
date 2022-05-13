# Packagified Laravel
This is the main package that collects the other packages in this family.

## Installation
```
sail composer require bakgul/packagified-laravel --dev
```
## Commands
This packages ships with one command.

### Build
This command will prepare your repository when it's executed. But before you call it, make sure you set repository type properly. After you publishing the settings, go to ```config/packagify.php``` and search for "repository" to see the settings. You will find the comments there too. Please read them to get explanations.
```
sail artisan build-pl
```
#### Arguments
This command accepts no argument.

#### Options
This command accepts no option.

## In the Future Release
I'm planing to add a functionality to install all dependencies and node modules automatically while build-pl is running. 

## The Packages That Will Be Installed By This Package
+ **[Command Evaluator](https://github.com/bulentAkgul/command-evaluator)**
+ **[File Content](https://github.com/bulentAkgul/file-content)**
+ **[File History](https://github.com/bulentAkgul/file-history)**
+ **[Kernel](https://github.com/bulentAkgul/kernel)**
+ **[Laravel File Creator](https://github.com/bulentAkgul/laravel-file-creator)**
+ **[Laravel Resource Creator](https://github.com/bulentAkgul/laravel-resource-creator)**
+ **[Laravel Package Generator](https://github.com/bulentAkgul/laravel-package-generator)**