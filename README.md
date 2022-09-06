This project use docker for development.

## How to run the app.

You can run the system by using two ways:

1. Run using the old way by access index.php and don't forget to run phpMyAdmin,
then import database.sql.

2. Run in the root of the your system if you are using linux or unix 
by opening the terminal.

### `sudo docker-compose up app`

The docker-compose file has all configurations on how to run the sytem and database.
No need to run your own phpMyAdmin, just add the .env file by refering to .env.example then import database.sql.

Use your postman or something else to access your API.

If you don’t have docker install in your system check this links:
1. https://docs.docker.com/engine/install/ubuntu/ (install on linux)
2. https://docs.docker.com/desktop/install/windows-install/ (install on windows)
3. https://docs.docker.com/desktop/install/mac-install/ (install on mac)
