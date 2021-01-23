# Silverstripe Checkbox Group Field

A CMS field that allows for a Title field to be turned on and off via a checkbox.

## Contents

- [Installation](#installation)
- [Issues](#issues)
- [Contribution](#contribution)
- [License](#license)


## Installation

Using `composer`, install the module:

```bash
composer require silverstripe/checkboxgroupfield
```

After the the module is installed, apply `SilverStripe\CheckboxGroupField\Extensions\TextCheckboxGroupDataExtension` to the class you want the field on:

```yml
My\Sample\Class:
  extensions:
    - SilverStripe\CheckboxGroupField\Extensions\TextCheckboxGroupDataExtension
```

Once you have applied the extension, re-build the database and flush via cli or in browser:

```bash
$php vendor/silvertripe/framework/cli-script.php dev/build "flush=all"
```

`http://yoursite.test/dev/build?flush=all`

## Issues

Please use the [GitHub issue tracker](https://github.com/silverstripe/silverstripe-checkboxgroupfield/issues) for bug reports and feature requests.

## Contribution

Your contributions are gladly welcomed to help make this project better.
Please see [contributing](CONTRIBUTING.md) for more information.


## License

[BSD-3-Clause](LICENSE.md) &copy; Silverstripe

[silverstripe]: https://github.com/silverstripe/silverstripe-framework
[webpack]: https://webpack.js.org
[issues]: https://github.com/praxisnetau/silverstripe-module-starter/issues
