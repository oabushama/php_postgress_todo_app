<?php
function insert_task($task)
{
    // validate the submitted/posted todo task
    $new_task = validate_input($task);
    if(empty($new_task)){
        return;
    }
    // create a prepared statement to protect against SQL injections
    $sql_query = "INSERT INTO tasks (task, date_added, done) VALUES(:task, :date_value, DEFAULT)";
    $date = new DateTime("now", new DateTimeZone('Asia/Riyadh'));
    $date = $date->format('Y-m-d H:i:s');
    $insert_statement = $GLOBALS['conn']->prepare($sql_query);
    if ($insert_statement) {
        // Bind our variable to the prepared statement as a parameter
        $insert_statement->bindParam('task', $new_task);
        $insert_statement->bindParam('date_value', $date, PDO::PARAM_STR);
        /* execute the prepared statement, and check if it was successful
        * If it was inserted successfully, then the affected rows should be 1
        */
        if (!$insert_statement->execute() || $insert_statement->rowCount() !=1) {
            print_r('Error executing SQL insert statement: ' . $insert_statement->err);
            return;
        }
    } else {
        printf("Failed to insert into the database:Erro number: %d,  %s\n",
        $insert_statement->errorCode(), $insert_statement->errorInfo());
    }
}

// trim any extra white spaces and escape special HTML characters
function validate_input($data)
{
    $data = trim($data); 
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>