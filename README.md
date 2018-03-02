# Laravel - Painless legacy

With this package, you can use some Laravel v5.3+ features in the v5.2.

## Features

### Middlewares

* ConvertEmptyStringsToNull: `Pallares\LaravelPainlessLegacy\Foundation\Http\Middleware\ConvertEmptyStringsToNull`
* TrimStrings: `Pallares\LaravelPainlessLegacy\Foundation\Http\Middleware\TrimStrings`

Usage: use the middlewares directly.

### Http

* Request `validate` macro.

Usage: register the `Pallares\LaravelPainlessLegacy\Http\HttpServiceProvider` service provider.

### Helpers

* tap

Usage: use the method directly.
