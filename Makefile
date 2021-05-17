
dev-up:
	docker run -d -p 8081:80 --name apache-php-app -v "$(PWD)":/var/www/html:Z php:7.2-apache
	echo "http://localhost:8081"

dev-down:
	docker rm -f apache-php-app
