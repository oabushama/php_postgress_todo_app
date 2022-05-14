<?php 
function get_all_todos()
{
    $sql_query = "SELECT id, task, date_added, done FROM tasks WHERE done = false;";
    $statement = $GLOBALS['conn']->prepare($sql_query);
    if ($statement && $statement->execute() && $statement->columnCount()> 0) {
        echo '<ul id="my-list">';
        while($row = $statement->fetch()) {
            echo "<li>".'<input type="checkbox" name="checkBoxList[]" value="'.$row["id"].'"><span>'.$row["task"]."</span></li>";
        }
        echo '</ul>';
    } else {
        echo '<h2>Your ToDo list is empty!</h2>';
    }
    $statement = null;
}
