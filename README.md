# PHP RestApi Crud Exercise
This exercise is focused on a blog post. Using PHP OOP, PDO with MySQL database, I created a rest exercise.

# Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Prerequisites
- PHP Server
- MySQL Databse
- Postman to test the api.

## Setup
- import the `myblog.sql` file to your database server, to create the database and tables
- The `Database.php` file contains the database connection, update with your own database credentials
- to call apis you do the (example: using localhost), use the following link in postman
    - get all post: `http://localhost/php_rest_crud/api/post/read.php`
    - get a single post: `http://localhost/php_rest_crud/api/post/read_single.php?id=3`
    - add (post request) a post: `http://localhost/php_rest_myblog/api/post/create.php`
        - in the body tab in postman add the data in a json format