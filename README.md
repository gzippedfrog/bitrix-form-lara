
### Требования
- composer
- docker-compose

### Инстукция к запуску
```bash
$ cp .env.exmple .env
$ composer install
$ ./vendor/bin/sail up -d
$ ./vendor/bin/sail npm install
$ ./vendor/bin/sail npm run dev
$ ./vendor/bin/sail artisan migrate
```
