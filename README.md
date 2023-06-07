1. Скопировать файл .env.example и переименовать его в .env
2. Внести в .env правки соответственно пользователю в системе, заменить пароль для БД
2. Выполнить команду
```bash
docker-compose up -d
```
2. Скопировать файл backend/.env.example и переименовать его в backend/.env
3. Внести в него правки: APP_URL (адрес сервиса), STORE_URL (API магазина), SYSTEM_URL (API системы)
4. Войти в контейнер командой
```bash
docker exec -ti backend-marketplace bash
```
5. Установить зависимости
```bash
composer install
```
6. Выполнить миграции
```bash
php artisan migrate
```
