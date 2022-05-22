# Docker - Bitrix:

Docker ��������� ��� Bitrix ������

## ������� �������� �� ������� �������������� ��������� �� ���������

- ��������� git pull
- �������� � **hosts** ���� ������������ ip � ���������� ������
  ```
    127.0.0.100 site.loc
  ```
  ���� ����������� ��������� ������, ��:
  ```
    127.0.0.100 site1.loc
    127.0.0.100 site2.loc
  ```
- ������� ������� � ������� � ���������� � ������������
- ��������� �������
    ```
    docker-compose up -d --build
    ```
- ��������� � ��������, ��� ���� **http://site.loc** ����������� ���������

## ����� � ���������� ��� ��������� � �������������� ���������
- **.env** - ���� �������� ��������
    ```
    ����� ������������� ����� ���������, ��� IP �����, ���� �� ������� �������� ���������,
    adminer, � ��.
    ```
- **docker-compose.yml**
    ```
    �������� �������� ����������� �� ������ ���������� � .env
    ```
- ���������� **www**
    ```
    ����� ���������� �����, ���������������� � �������� ������� ����������.
    �������� ����� ������ � ������ ��������� � �� ����
    ��������� ���������:
    - www
        - site.loc
            - apache_logs #���� ����� site
            - public_html #����� site
            - mail #�����, ������������ � site
        ...
    
    � ���������� mail ����������� ��������� �������� ��������� � ������� ".eml".
    ���������� ����� � ���������� mail ������� � ������� �������� mail.php, 
    ������� ������� � ���� "sendmail_path" � ����� bx.ini
    ``` 
- ���������� **web**
    ```
    �������� ��������� �����:
    - bitrix.ini: � ��� ��������� ��������� ��� php.ini ��� ���������� ������ Bitrix
    - Dockerfile: ���������� ��� ������� ���������� �� ������ image PHP � ���������� Apache.
    �� ��������� ������������ php:7.4-apache
    - sites.conf: ���� �������� ����������� ������ ��� Apache.
    - mail.php: ������-�������� ��� ��������� php ������� mail
    - opcache.ini: ��������� ��� ��������� opcache
    ```
- ���������� **databases**
    ```
    ����� ���������� �����, ���������������� � �������� ������� ����������.
    �������� �� � ������ ����������� ���������.
    ```
- ���������� **db**
    ```
    �������� ��������� �����:
    - bitrix.cnf: � ��� ��������� ��������� ��� ���������� ������ ���� ������ ��� Bitrix
    - Dockerfile: ���������� ��� ������� ���������� �� ������ image MySQL.
    �� ��������� ������������ mysql:5.6
    ```    
## �����
��� ������ ����� (����������� � � ���������� **mail**) ���������� � ����� **dbconn.php** (���� � ��� �������)
���������� ��������� ���������:
```
define("BX_CRONTAB_SUPPORT", false);
define("BX_CRONTAB", false);
```