# Status Microservice

![](https://github.com/Automated-Medical-Assistant/microservice-service-status/workflows/test/badge.svg)


# Purpose
This Microservice is one piece of multiple services for an COVID-19 test result application.
This project was made @ [#WirVsViren](https://wirvsvirushackathon.org/) Hackathon.

###### Technical Requirements

* Install PHP 7.4 or higher and these PHP extensions (which are installed and enabled by default in most PHP 7 installations): Ctype, iconv, JSON, PCRE, Session, SimpleXML, and Tokenizer;
* Install Composer, which is used to install PHP packages;


##### RabbitMQ
Login: admin  
Pass: admin

###### Setup
```
docker-compose pull
docker-compose up -d
composer install
bin/console doctrine:database:create 
bin/console doctrine:migrations:migrate
symfony serve
```


