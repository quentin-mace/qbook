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