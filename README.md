# Packagified Laravel

This is the main package that collects the other packages in this family to perform fully.
-   [**Command Evaluator**](https://github.com/bulentAkgul/command-evaluator)
-   [**File Content**](https://github.com/bulentAkgul/file-content)
-   [**File History**](https://github.com/bulentAkgul/file-history)
-   [**Kernel**](https://github.com/bulentAkgul/kernel)
-   [**Laravel File Creator**](https://github.com/bulentAkgul/laravel-file-creator)
-   [**Laravel Resource Creator**](https://github.com/bulentAkgul/laravel-resource-creator)
-   [**Laravel Code Generator**](https://github.com/bulentAkgul/laravel-code-generator)
-   [**Laravel Package Generator**](https://github.com/bulentAkgul/laravel-package-generator)

#### DISCLAIMER
It should be production-ready but hasn't been tested enough. You should use it carefully since this package will manipulate your files and folders. Always use a version-control.

## Installation
```
sail composer require bakgul/packagified-laravel --dev
```
Next, you need to publish the settings by executing the following command. By doing so, you will have a new file named *packagify.php* on the config folder. If you check the "**files**" array, you can see the file types that can be created. Quite deep explanations are provided in the comment block of the files array.

```
sail artisan packagify:publish-config
```

After publishing stubs, you will be able to update the stub files as you need. It's safe to delete the unedited files.
```
sail artisan packagify:publish-stub
```

## Commands

#### VERY IMPORTANT NOTE
You should use this command unless you have a freshly installed Laravel app. This command will wipe out some folders, and you will probably lose your previous codes.

```
sail artisan build-pl
```

This command will prepare your repository when it's executed. But before you call it, make sure you set repository type properly. After publishing the settings, go to config/packagify.php and search for "repository" to see the settings. You will find the comments there too. Please read them to get explanations.

### Arguments
This command accepts no argument.

### Options
This command accepts no option.