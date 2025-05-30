## Инструкция по развертыванию Laravel приложения

**1. Клонируйте репозиторий:**

```
bash
git clone https://github.com/tomoe1337/e-comAPI
```
**2. Установите зависимости Composer:**

Перейдите в директорию вашего проекта и установите все необходимые пакеты с помощью Composer:
```
bash
cd e-comAPI
composer install 
```

**3. Скопируйте файл окружения:**

Создайте файл `.env` на основе `.env.example`:
```
bash
cp .env.example .env
```
**4. Сгенерируйте ключ приложения:**

Сгенерируйте уникальный ключ для вашего приложения Laravel:

```
bash
php artisan key:generate
```
**5. Настройте файл `.env`:**

Отредактируйте файл `.env` и укажите данные для подключения к вашей базе данных, настройки почты, URL приложения и другие необходимые параметры.
```
DB_CONNECTION=sqlite
#DB_HOST=127.0.0.1
#DB_PORT=3306
#DB_DATABASE=your_database
#DB_USERNAME=your_username
#DB_PASSWORD=your_password

# И другие настройки
```
**6. Выполните миграции базы данных:**

Выполните миграции, чтобы создать необходимые таблицы в базе данных:
```
bash
php artisan migrate:fresh --seed
```

`--seed длля заполнения бд тестовыми данными`

при использовании появится пользователь 
email: laravel@mail.ru
password: Laravel123

**7. Запустите сервер:**

```
bash
php artisan serve
```
**7. В отдельном терминале запустите планировщик событий:**

```
bash
php artisan schedule:work 
```

`Необходимо для отмены заказов неоплаченных за 2 минуты`

