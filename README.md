# QBook
QBook is an Open Source rooms booking software

## Initialize the projet
After cloning the project to your computer, duplicate these files :
* `docker-compose.distant.yml` into `docker-compose.yml`
* `config/config.distant.php` into `config/config.php`

Then, into the new config files, change this :
* In `docker-compose.yml` add your own root username and password at lines `18`, `32` and `33`
* In `config/config.php` also add your own user and password as second parameter to the `define()` function.
It must match those defined in your `docker-compose.yml`.

Make also sure you have docker installed on your computer.

Then, you can launch the command `docker compose up -d` to run the server. 

Now you can connect to the database here : http://localhost:7978

Once on _PHPmyadmin_ you can click on the database **"qbook"** then click **"import"**, ant then select the dump file `qbook.sql`

Once everything above is done, you can connect to the website with the URL : http://localhost:7979
