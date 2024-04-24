#### handling Controllers ####

# create a controller
php8.3 artisan make:controller EventController

#### handling Migrations ####

# create migrations which is not set
php8.3 artisan migrate

# define a migration file, but don't run it
php8.3 artisan make:migration create_product_table

# update table with a new migration
php8.3 artisan make:migration add_category_to_products_table

# show migrations validation flag and batch amount
php8.3 artisan migrate:status

# drop all tables and run migrations again (it delete data)
php8.3 artisan migrate:fresh

# run migrations again but does not erase data
php8.3 artisan migrate:refresh

# back 1 migration command (it can delete data)
php8.3 artisan migrate:rollback

# back all migration commands (it detele data)
php8.3 artisan migrate:reset