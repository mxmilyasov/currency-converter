[![Maintainability](https://api.codeclimate.com/v1/badges/3c3bd7eaeb50702ebde5/maintainability)](https://codeclimate.com/github/mxmilyasov/currency-converter/maintainability)
![PHP CI](https://github.com/mxmilyasov/currency-converter/workflows/PHP%20CI/badge.svg)
# [CRNCONVERT](https://php-currency-converter.herokuapp.com/)

---
## Description
Simple online currency converter. In the project used the following technologies:
- PHP 8.0
- MySQL
- Doctrine
- Composer
- Twig
- PHPStan
- PHP CodeSniffer
- Heroku

## Setup
```sh
$ git clone https://github.com/mxmilyasov/currency-converter.git
$ cd currency-converter
$ make install
```
After that: 
1. Create database.
2. Add **.env** to root project and fill like **.env.example**.
3. Import tables with dump (*public/data/tables-dump.sql*).
4. Import currencies with dump (*public/data/currencies.sql*).
```sh
$ make serve
```
The project is [deployed](https://php-currency-converter.herokuapp.com/) on Heroku.

---