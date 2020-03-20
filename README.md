#Laravel Back-end project by DukeLee

1. How to test the demo
	- clone the repository
	- connect your DB(Mysql) in .env file
	- run php artisan migrate
2. Init dummy data using seeder
	- in database/seeds create  PermissionSeeder and RoleSeeder using:
		php artisan make:seeder 'name'
	- add initialize user, role and permission as you want.
	- remember that in this project the role and the permission are not
	connected.
