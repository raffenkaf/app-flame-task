## Порядок запуску проекту трохи відрізняється від ТЗ:
### Зверність увагу - composer setup а не composer install 
1. composer **_setup_**
2. docker-compose up -d

## Також є нюанс з областями:
Київ та Севастополь є окремими сутностями(міста республіканського значення).
Тому точка в Києві буде відповідати Києву, а не Київській області.

## Власне ТЗ:
Task: Create a git repository with code for an app that satisfies requirements below.
Time needed: 3h min, 1d max.
Components: Docker, MySQL, Redis, Laravel, PHP, Memcached.

Starts an application:
$ docker compose up -d

Queues background job via Redis, to download and insert/upsert data in specified number of seconds:
$ curl -s -X PUT 'http://127.0.0.1:8081/data?action=refresh&delaySeconds=123'
{"data": {"success": true}}

Gets status of background job that is not finished:


$ curl 'http://127.0.0.1:8081/jobs?action=list&limit=1'
{"data": [{"createdTs": 1712670771, "sheduledForTs": 1712670831, "state": 0}]}

Gets status of background job that is finished:
$ curl 'http://127.0.0.1:8081/jobs?action=list&limit=1'
{"data": [{"createTs": 1712670771, "scheduledForTs": 1712670831, "state": 2}]}

Background job handler behavior: downloads polygons of all oblasts of Ukraine from Nominatim public API, and saves them into MySQL.

Queries the data in MySQL, caches response in Memcached:
$ curl 'http://127.0.0.1:8081/data?action=search&lat=50.4753622&lon=30.4193448'
{"data": {"geo": {"oblast": "Kyiv Oblast"}, "cache": "miss"}}

Purges the data:
$ curl -X DELETE http://127.0.0.1:8081/data
{"data": {"status": "success"}}


