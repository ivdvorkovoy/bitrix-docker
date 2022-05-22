FROM mysql:5.6

RUN apt-get update && apt-get install -y \
    mc

#добавление директив mysqld
COPY db.cnf /etc/mysql/mysql.conf.d/