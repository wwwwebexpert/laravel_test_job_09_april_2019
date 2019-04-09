
Hello 

Greetings !!!!


1) In zip folder we are sent the whole laravel folder expect vendor foler. You can run composer update command and vendor folder will automatically generated.

2) In zip folder also have test_job.sql file you can directly go to phpmyadmin and creat database and import that test_job.sql file.

3) Come to you laravel folder and edit the .env file and change below credential as per you machine 

DB_DATABASE= your new created database name
DB_USERNAME= your phpmyadmin user name
DB_PASSWORD= your phpmyadmin password if you setted otherwise leave it blank.

4) Once this process done by you then go to terminal type : cd /var/www/html/ your folder name of this project/ + enter

5) Now you are in side folder and  run this command 

php artisan key:generate

then run command 

php artisan serve

then you can see Laravel development server started: <http://127.0.0.1:8000>

Hit this url http://127.0.0.1:8000 and login with credentials 

yuvraj.singh@mobilyte.com / Yuvraj@123


After this you can see admin dashboard 

Then Go to tabs 

1) Teams -> Create team / Update team / delete team
2) Users -> Create Users / Update Users / delete Users => Assign team to user / Set as team owner / Assign role to user 
3) Roles -> Create Role / Update role / delete Role

Note : The items  those are indicating like Super admin / Main role they don't have delete option rest are have.


List if the user along with pagination and it will indicate all the relation with the teams & role and owner ship kind of 


Rest if you got any obstacle or issue then please feel free to contact us.


Thanks & Regards

Mobilyte Solutions




