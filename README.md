# ToDo app
A simple todo app written in PHP and uses PostgreSQL as a database to store todo items. This is a CRUD app (Create, Retrieve, Update, and Delete) in PHP using the database-independent PDO extension.


## Usage

### Setting up the database

You will need to install PostgreSQL and connect to the databse server using either the command line client `psql -U username -W' or a GUI client like pgAdmin. 
First, we will create a file called `database.ini` that contains the database connection parameters and access credentials. Example:

```plaintext
host=localhost
port=5432
database=apps.tasks
user=todoappusr
password=YOUR_PASSWORD
```

Next, we will create a table called *tasks* with the following definition:

```
+------------+--------------------------+------+-----+---------+
| Field      | Type                     | Null | Key | Default |
+------------+--------------------------+------+-----+---------+
| id         | SERIAL                   | NO   | PRI | NULL    |
| task       | CHARACTER varying(255)   | NO   |     | NULL    |
| date_added | TIME with time zone      | NO   |     | NULL    |
| done       | BOOLEAN DEFAULT          | NO   |     | FALSE   |
+------------+--------------------------+------+-----+---------+
```

Below is the SQL code for creating the database and table as well as the user and role for our php app that will access the database. Please make sure that the password you choose when creating a user is the same password defined in your `database.ini`.

```sql
/* create a read/write for the php app that accesses the database */
CREATE ROLE readwrite;
/* Create user */
CREATE USER todoappusr WITH PASSWORD 'YOUR_PASSWORD';
/* Add user to the role */
GRANT readwrite TO todoappusr;
/* create a database */
CREATE DATABASE tododb;
/* Grant this role permission to connect to the target database: */
GRANT CONNECT ON DATABASE tododb TO readwrite;
/* Connect to the database */
\c tododb;
/* Create schema*/
CREATE SCHEMA IF NOT EXISTS apps;
/* Create table */
CREATE TABLE IF NOT EXISTS apps.tasks (
    id SERIAL PRIMARY KEY,
    task CHARACTER varying(255) NOT NULL,
    date_added TIME with time zone NOT NULL,
    done BOOLEAN DEFAULT false NOT NULL
);
/* Grant usage on schema and auto increment columns  */
GRANT USAGE, SELECT ON ALL SEQUENCES IN SCHEMA apps TO readwrite;
/* Set the default schema for the user */
ALTER ROLE todoappusr SET search_path = apps;
/* Grant table access privileges */
GRANT SELECT, INSERT, UPDATE, DELETE ON TABLE apps.tasks TO readwrite;
```


### Install and enable the PostgreSQL PDO database driver for PHP

You will need to install and enable the PHP PDO PostgreSQL driver in the configuration file (`php.ini` file). In the `php.ini` file, you can find the line that contains `extension=php_pdo_pgsql` and uncomment it (remove the semicolon).


### Running the PHP app
Once the database has been installed and the table has been created, simply run the app by serving it from a web server. You may use any web server to serve the app (e.g., Apache HTTP Server, nginx) or PHP's built-in web server:

`php -S localhost:8080 -t ./`

