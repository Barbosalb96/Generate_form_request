
# barbosalb96/blade

A Laravel package for generating Blade form templates based on a request class with validation rules.

## Installation

You can install this package via Composer. Run the following command in your Laravel project:

```bash
composer require barbosalb96/blade:dev-master --prefer-stable
```

Once installed, the package will automatically register its service provider.

## Usage

After installation, you can use the `make:form-from-request` command to generate a Blade form based on an existing request class.

### Command Syntax

```bash
php artisan make:form-from-request {request}  {type}
```

- `{request}`: The name of the request class (e.g., `UserRequest`).
- `{type}`: The form style to generate. This can be either `tailwind` or `bootstrap`.

### Example

To generate a Blade form from a request class `UserRequest` with Tailwind CSS styling:

```bash
php artisan make:form-from-request UserRequest type tailwind
```

This will generate a Blade view in `resources/views/UserRequest.blade.php` based on the validation rules defined in the `UserRequest` class.

### Form Fields

The form fields are automatically generated based on the validation rules of the request class. The following field types are supported:

- **text**: For string-based fields.
- **number**: For integer fields.
- **checkbox**: For boolean fields.
- **date**: For date fields.
- **email**: For email fields.

### Views

The Blade views are generated from two templates:

- `form_template_tailwind`: For generating forms with Tailwind CSS classes.
- `form_template_bootstrap`: For generating forms with Bootstrap classes.

You can customize these templates by publishing them to your application:

```bash
php artisan vendor:publish --provider="barbosalb96\Blade\GenerateBladeFromRequestServiceProvider" --tag="views"
```

The views will be published to `resources/views/vendor/lucas/blade`.

## Service Provider

The package includes a service provider (`GenerateBladeFromRequestServiceProvider`) that registers the necessary commands and views.

## Contributing

Feel free to fork the repository and create a pull request if you have suggestions for improvements or bug fixes.

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
