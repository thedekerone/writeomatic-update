FROM mysql:latest

ENV MYSQL_DATABASE=u625959064_writeomatic_db \
    MYSQL_USER=u625959064_admin_db \
    MYSQL_PASSWORD=Writeomaticadmindb1 \
    MYSQL_ROOT_PASSWORD=your_strong_root_password

COPY u625959064_writeomatic_db.sql /docker-entrypoint-initdb.d/

