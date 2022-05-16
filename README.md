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

Below is the SQL code for creating the database table as well as the user and role for our php app that will access the database.

```sql
/* Create table */
CREATE TABLE IF NOT EXISTS tasks (
    id SERIAL PRIMARY KEY,
    task CHARACTER varying(255) NOT NULL,
    date_added TIME with time zone NOT NULL,
    done BOOLEAN DEFAULT false NOT NULL
);
```


### Install and enable the PostgreSQL PDO database driver for PHP

You will need to install and enable the PHP PDO PostgreSQL driver in the configuration file (`php.ini` file, which is typically located at the root PHP installation directory). In the `php.ini` file, you can find the line that contains `extension=php_pdo_pgsql` and uncomment it (remove the semicolon).


### Running the PHP app
Once the database has been installed and the table has been created, simply run the app by serving it from a web server. You may use any web server to serve the app (e.g., Apache HTTP Server, nginx) or PHP's built-in web server:

`php -S localhost:8080 -t ./`

