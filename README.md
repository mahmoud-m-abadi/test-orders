
## Installation

1. Run the following command in root of project: <br />
   `docker-compose build && docker-compose up -d`

2. docker exec -it order_php sh -c `"cp .env.example .env &&
   composer install &&
   php artisan key:generate &&
   php artisan migrate &&
   php artisan db:seed"`

3. if you need to test application run: <br />
   `docker exec -it order_php sh -c "php artisan test"`

4. URLs:<br />
    `MAIN URL: localhost:82` <br />
   `PHPMyAdmin URL: localhost:83  -- {user: root} {password: secret}`

5. The sample of Postman json file is attached.
