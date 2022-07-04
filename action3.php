<?php
include "connection.php";
header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');
if (isset($_REQUEST["auditorium"])) {
    try{
    $auditorium = $_REQUEST["auditorium"];
    $statement = $dbh->prepare(
        "SELECT * from $db.lesson where $db.lesson.auditorium = :auditorium"
    );
    $statement->execute(array('auditorium' => $auditorium));
    $cell=$statement->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($cell);
    }catch(PDOException $e){
        echo "Ошибка " . $e->getMessage();
    }
}
?>