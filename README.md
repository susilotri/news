Steps to deploy:

1. Clone the project from Git.(https://github.com/susilotri/news.git)
2. Set up the environment variables (refer to the .env.example file).
3. In the terminal, run the command "composer install" (assuming that Composer is already installed).
4. Still in the terminal, run the command "php artisan migrate".
5. Then, run the command "php artisan migrate --seed".
6. To run the application, use "php artisan serve" or deploy it to a web server.
7. run "php artisan queue:work" to run queueing for commnets.
8. for postman collection join in this url "https://app.getpostman.com/join-team?invite_code=6a7685d48212bdd456528fac4a2a185f"

nb: make sure you have install redis for queueing comments.