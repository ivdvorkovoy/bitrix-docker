FROM php:7.4-apache

RUN apt-get update && apt-get install -y \
    mc \
    cron \
    zip \
    unzip \
    libxml2-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libfreetype6-dev \
    libonig-dev \
    libpq-dev \
    libz-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_mysql \
    mysqli \
    mbstring \
    json \
    xml \
    zip \
    opcache \
&& docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd

#добавление отладчика
RUN pecl install zlib zip xdebug && docker-php-ext-enable xdebug

#установка необходимых локалей
RUN apt-get install -y locales locales-all
RUN localedef -i en_US -f UTF-8 en_US.UTF-8; \
      localedef -i ru_RU -f UTF-8 ru_RU.UTF-8; \
      localedef -i ru_RU -f CP1251 ru_RU.CP1251

#копирование скрипта-заглушки для обработки функции php mail
RUN mkdir /var/www/system_dir
COPY mail.php /var/www/system_dir

#добавление директив php.ini
ADD ./php.ini /usr/local/etc/php/conf.d/php.ini

#создание виртуальных хостов
COPY sites.conf /etc/apache2/sites-available/000-default.conf

#включение mod rewrite Apache
RUN ln -s /etc/apache2/mods-available/rewrite.load /etc/apache2/mods-enabled/rewrite.load

#добавление настроек opcache
COPY opcache.ini /usr/local/etc/php/conf.d/opcache.ini

#настройка прав каталогов
RUN usermod -u 1000 www-data
RUN chmod 777 -R /tmp && chmod o+t -R /tmp