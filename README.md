
### Требования
- composer
- docker-compose

### Инстукция к запуску
добавить бота https://t.me/bitrixleadsbot в телеграм канал и разрешить создавать сообщения

затем
```bash
$ cp .env.example .env
```

указать правильные значения для id телеграм канала и URL битрикс24 в .env:
- TELEGRAM_CHAT_ID
- BITRIX_URL
- BITRIX_WEBHOOK_URL

затем 
```bash
$ composer install
$ ./vendor/bin/sail up -d
$ ./vendor/bin/sail npm install
$ ./vendor/bin/sail npm run dev
$ ./vendor/bin/sail artisan migrate
```
