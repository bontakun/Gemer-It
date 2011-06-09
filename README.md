Gemer It Project
=============

This project is a simple (but kind of fun) url shortener written in PHP with a MySQL database for a backend and a very simple fast interface.

Contributing
------------

To Contribute, please just contact the administrator bontakun for access.

Setup
------------

Database schemas are in scripts/schema.sql. Database configuration is stored in library/config.php.

Structure
------------

Gemer It is setup very similar to MVC, it's a little more liberal about some tenants of MVC in order to keep things simple. The rough structure is that the controllers are here in the root, views are in the views folder, and models don't really exist, but the closest thing we have is in the models/library.php file.