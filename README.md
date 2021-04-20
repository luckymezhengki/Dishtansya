# dishtansya
# Laravel API
1. Registration API 
2. Authentication / Login API 
3. Order API

execute this line for JWT Package used
**php artisan jwt:secret **

Update the .env file with the following line used for queuing:
**QUEUE_CONNECTION=database**

for seeding and fresh record please execute
**php artisan migrate:fresh**

to make jobs work please execute
**php artisan queue:work**
