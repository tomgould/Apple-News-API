# Contributing

Thank you for considering contributing to the Apple News API PHP Client!

## Development Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/tomgould/apple-news-api.git
   cd apple-news-api
   ```

2. Install dependencies:
   ```bash
   composer install
   ```

3. Run tests:
   ```bash
   composer test
   ```

4. Run static analysis:
   ```bash
   composer analyse
   ```

## Pull Request Process

1. Fork the repository and create a feature branch
2. Write tests for any new functionality
3. Ensure all tests pass: `composer test`
4. Ensure code passes static analysis: `composer analyse`
5. Update documentation if needed
6. Submit a pull request

## Coding Standards

- Follow PSR-12 coding standards
- Use strict types in all PHP files
- Add PHPDoc blocks to all public methods
- Maintain backward compatibility when possible

## Reporting Issues

Please include:
- PHP version
- Library version
- Minimal code example to reproduce the issue
- Expected vs actual behavior

