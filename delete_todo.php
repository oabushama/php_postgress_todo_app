<?php 

function delete_item($checkBoxList){
    foreach($checkBoxList as $value) {
        // create a prepared update statement
        $delete_statement = $GLOBALS['conn']->prepare("DELETE FROM apps.tasks WHERE id = ?");
        if($delete_statement) {
            $delete_statement->bindParam(1, $value, PDO::PARAM_INT);
            if (!$delete_statement->execute()) {
                printf("Error executing SQL delete statement: Erro number: %d,  %s\n",
                $delete_statement->errorCode(), $delete_statement->errorInfo());
                return;
            }
        }
    }
}

?>