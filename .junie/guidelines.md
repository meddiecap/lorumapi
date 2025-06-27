# API

- Use single API routes don't use ApiResource for routing.
- Responses should use Resource classes.
- Controllers should use form requests for validation.

# Frontend Development

## Blade Templates
- Use Blade components for reusable UI elements.
- Use Blade layouts for consistent page structure.
- Use translation functions for internationalization.
- Use proper indentation and formatting for readability.

## CSS and JavaScript
- Use Tailwind CSS for styling.
- Use Vue.js for frontend interactivity.
- Use Laravel Vite for asset compilation.
- Follow the BEM (Block Element Modifier) methodology for custom CSS.
- Use ES6+ features for JavaScript.

## Accessibility
- Use semantic HTML elements.
- Use ARIA attributes for enhanced accessibility.
- Ensure proper color contrast for text.
- Ensure keyboard navigation works correctly.
- Test with screen readers and other assistive technologies.

# General Guidelines

## PHP Code Style
- Follow the Laravel coding style as defined in the [Laravel documentation](https://laravel.com/docs/master/contributions#coding-style).
- Use Laravel Pint for code formatting with the Laravel preset.
- Use strict typing with `declare(strict_types=1)` at the top of PHP files.
- Use proper type hints for method parameters and return types.
- Use PHPDoc blocks for properties, methods, and functions with proper type annotations.
- Always import classes instead of using fully qualified class names (FQCNs)
- All methods must have type hints and return types, including model scopes and relationships
- Use camelCase for variables and methods, PascalCase for classes, and snake_case for database fields.
- Keep methods small and focused on a single responsibility.
- Use meaningful variable and method names that describe their purpose.
- PHPDoc types should use generics for collections and arrays

Example:
```php
/**
* Get the user's orders.
*
* @return HasMany<Order>
*/
public function orders(): HasMany
{
  return $this->hasMany(Order::class);
}
```

## Static Analysis
- Maintain a high level of code quality with PHPStan (level 8).
- Fix static analysis issues before committing code.
- Use IDE helpers for better code completion and static analysis.

## General
- Follow the Laravel documentation for the latest best practices.
- Use Laravel's built-in features instead of reinventing the wheel.
- Use dependency injection instead of facades when possible for better testability.
- Use environment variables for configuration.
- Use Laravel's validation features for input validation in form requests
- Use permissions checks via Spatie Permissions package (installed) features for access control.

## Database
- Use migrations for database schema changes.
- Use UUID as the primary key with a name of id
- for relations use foreignUuid
- don't use enum column prefer to store as string and use Enum classes
- Use factories and seeders for test data.
- Use Eloquent relationships to define relationships between models.
- Use annotations query scopes for common query patterns. Use laravel 12 scope attributes.
- Use database transactions for operations that need to be atomic.

## Security
- Use Laravel's authentication and authorization features.
- Validate all user input.
- Use CSRF protection for forms.
- Use Laravel's encryption and hashing features.
- Implement proper error handling and logging.

## Models
- Models must create a `newFactory` method when using `HasFactory`
- Models should use `/** @use HasFactory<ModelNameFactory> */` when using `use HasFactory;`
- Models relationships must include docblocks for @param and @return types including generics.
- Fillables must include `@var list<string>`

- Example:
```php
/** @use HasFactory<TodoFactory> */
use HasFactory;

/**
 * The attributes that are mass assignable.
 *
 * @var list<string>
 */
protected $fillable = [
    'title',
    'description',
    'completed',
];

protected static function newFactory(): TodoFactory
{
    return TodoFactory::new();
}
```

# Tests

All use cases should be tested to have as much code coverage as possible.

## Testing Approach
- Use Pest PHP for testing.
    - Test method should use `test()`
    - use $this->get() etc. instead of get() and related functions.
- Organize tests to mirror the application structure.
- Use descriptive test names that explain what is being tested.
- Use factories and seeders for test data.
- Use database transactions for test isolation.

## Test Types
- Unit Tests: Test individual classes and methods in isolation.
- Feature Tests: Test the integration of multiple components.

## Test Coverage
- Aim for high test coverage, especially for critical paths.
- Test edge cases and error conditions.
- Test both happy and unhappy paths.
- Test authorization and validation.
