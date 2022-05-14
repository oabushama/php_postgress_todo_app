<?php 
// Iterate through a list of ids of the todo items and mark them done
function mark_as_done($checkBoxList) {
    foreach($checkBoxList as $value) {
        // create a prepared update statement
        $update_statement = $GLOBALS['conn']->prepare("UPDATE tasks SET done = true WHERE id = ?");
        if($update_statement) {
            $update_statement->bindParam(1, $value, PDO::PARAM_INT);
            if (!$update_statement->execute()) {
                printf("Error executing SQL update statement: Erro number: %d,  %s\n",
                $update_statement->errorCode(), $update_statement->errorInfo());
                return;
            }
        }
    }
}
?>

