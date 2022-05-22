FROM mysql:5.7

RUN apt-get update && apt-get install -y \
    mc

#добавление директив mysqld
COPY mysql.cnf /etc/mysql/mysql.conf.d/