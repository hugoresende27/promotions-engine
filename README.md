- https://www.youtube.com/watch?v=pZv93AEJhS8&list=PLQH1-k79HB3_lsClhpW1svbukj6zgcupR

- database : docker run --name mysql-container -e MYSQL_ROOT_PASSWORD=root -p 3306:3306 -d mysql:latest v ~/mysql-data: var/lib/mysql


PRODUCT
- id (int)
- price (int)

PROMOTION
- id (int)
- name (string)
- type (string)
- adjustment (float)
- criteria (string|json)

========================================================

id: 1
name: Black Friday half price sale
type: date_range_multiplier
adjustment: 0.5
criteria: {"from": "2022-11-25", "to": "2022-11-28"}

========================================================

id: 2
name: Voucher OU812
type: fixed_price_voucher
adjustment: 100
criteria: {"code": "OU812"}

========================== DOCKER =========================

php bin/console make:docker:database
docker-compose up -d

symfony console make:migration
symfony console doctrine:migrations:migrate