# INF553
Step 3 of the project, web server

## How to run the server

* The configuration of the postgres connection is in the file :

**web/config.php** 

*You have to edit the five attributes to connect to your own postgres server.*

* Start your docker engine.

* Run the following command-line in root folder :

**docker-compose up**

## What it does

The docker starts two servers :
* On **localhost:8080**, you have a php server that is a our solution for Step 3.
* On **localhost:8081**, you have a adminer window, that is a GUI to query the database and actually check that our solution is correct. You will have to select **System** as **PostgreSQL**, **Server** as your Postgres server IP, and **User**, **Password** and **Database** accordingly.



*Louis Proffit, Paul Théron*