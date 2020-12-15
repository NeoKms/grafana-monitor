docker-compose up -d
sleep 10
docker exec mariadb sh -c "mysql -v -uroot -pdocker dictionary < /var/lib/mysql/dumps/initbackup" > /dev/null
