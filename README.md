Service provider for ABC banking group.

Provides user authentication, routing and business logic.

INSTALLATION
------------

Requirements:
- MySQL server
- composer.phar (https://getcomposer.org/)
- local server (it could be local php => "php -S localhost:8000" in the root of the service provider)

Steps:
1. Download composer
2. Execute "composer install" in root folder
3. Execute propel/sql/abcbanks.sql to create mysql bank db
4. Execute auth/propel/sql/abcbank_api.sql to create mysql auth db
5. Run local server on root