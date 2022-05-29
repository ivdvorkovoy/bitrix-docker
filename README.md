# Docker - Bitrix:

Docker окружение для Bitrix сайтов

## Краткое описание на примере разворачивания окружения по умолчанию

- Выполнить git pull
- Добавить в **hosts** файл соответствия ip и локального домена
  ```
    127.0.0.1 site-one.loc
    127.0.0.1 site-two.loc
  ```
- Открыть консоль и перейти в директорию с репозиторием
- Выполнить команду
    ```
    docker-compose up -d --build
    ```
- Проверить в браузере, что сайт **http://site.loc** открывается корректно

## Файлы и директории для настройки и разворачивания окружения
- **.env** - файл основных настроек
    ```
    Здесь зафиксированы такие настройки, как IP адрес, порт на котором работает окружение,
    adminer, и пр.
    ```
- **docker-compose.yml**
    ```
    Содержит описание контейнеров на основе переменных в .env
    ```
- директория **www**
    ```
    Общая директория хоста, примонтированная к файловой системе контейнера.
    Содержит файлы сайтов в рамках окружения и их логи
    Структура следующая:
    - www
        - site.loc
            - apache_logs #логи апача site.loc
            - public_html #файлы site.loc
            - mail #почта, отправляемая с site.loc
        ...
    
    В директории mail сохраняются исходящие почтовые сообщения в формате ".eml".
    Сохранение почты в директорию mail сделано с помощью заглушки mail.php, 
    которая указана в поле "sendmail_path" в файле bx.ini
    ``` 
- директория **php**
    ```
    Содержит следующие файлы:
    - php.ini: в нём прописаны директивы для php.ini для корректной работы Bitrix
    - Dockerfile: инструкция для запуска контейнера на основе image PHP с встроенным Apache.
    По умолчанию используется php:7.4-apache
    - sites.conf: файл описания виртуальных хостов для Apache.
    - mail.php: скрипт-заглушка для обработки php функции mail
    - opcache.ini: директивы для настройки opcache
    ```
- директория **databases**
    ```
    Общая директория хоста, примонтированная к файловой системе контейнера.
    Содержит БД в рамках запущенного окружения.
    ```
- директория **mysql**
    ```
    Содержит следующие файлы:
    - mysql.cnf: в нём прописаны директивы для корректной работы базы данных под Bitrix
    - Dockerfile: инструкция для запуска контейнера на основе image MySQL.
    По умолчанию используется mysql:5.7
    ```    
## Важно
Для работы почты (копирования её в директорию **mail**) необходимо в файле **dbconn.php** (если у вас Битрикс)
установить следующие директивы:
```
define("BX_CRONTAB_SUPPORT", false);
define("BX_CRONTAB", false);
```