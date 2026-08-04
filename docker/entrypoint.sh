#!/bin/sh
set -e

echo "Проверка существования базы данных..."
# Пытаемся выполнить простой запрос к вашей БД (имя указано в DATABASE_URL)
# Если БД нет — команда упадёт, мы это перехватываем
if php bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; then
    echo "База данных уже существует."
else
    echo "База данных не найдена. Создаём..."
    php bin/console doctrine:database:create --if-not-exists --no-interaction
    echo "База данных создана."
fi

echo "Ожидание готовности сервера базы данных..."
until php bin/console doctrine:query:sql "SELECT 1" > /dev/null 2>&1; do
    echo "   Сервер БД ещё не готов. Повтор через 2с..."
    sleep 2
done
echo "Сервер базы данных доступен."

echo "Запуск миграций..."
php bin/console doctrine:migrations:migrate --no-interaction --allow-no-migration
echo "Миграции выполнены."

echo "Запуск тестов..."
php bin/phpunit

# Выдать доступ к var
mkdir -p var
chown -R www-data:www-data var

echo "Старт php-fpm..."
exec php-fpm -F
