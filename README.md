## To start project
1. Create .env file and add your db credentials in .env file
2. Run command composer-install
3. php artisan migrate
4. php artisan db:seed - this command will seed database by using data from Excel file and will add related data to the Tariff table


## Without Database
If you want to test application without creating database just serve application and make post request to '/api/tarifs/process'
