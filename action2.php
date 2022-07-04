<?php
include "connection.php";
header('Content-Type: text/xml');
header('Cache-Control: no-cache, must-revalidate');
if (isset($_REQUEST["teachers"])) {
    try{
    echo '<?xml version="1.0" encoding="utf-8"?>';
    echo "<root>";
    $teacher = $_REQUEST["teachers"];
    $statement = $dbh->prepare(
        "SELECT * from $db.teacher 
        join $db.lesson_teacher 
        on $db.teacher.ID_teacher = $db.lesson_teacher.FID_teacher 
        join $db.lesson 
        on $db.lesson_teacher.FID_Lesson1=$db.lesson.ID_Lesson 
        where $db.teacher.name = :teachers"
    );
    $statement->execute(array('teachers'=>$teacher));
    while ($cell = $statement->fetch(PDO::FETCH_BOTH)) {
        $day = $cell[5];
        $number = $cell[6];
        $auditorium = $cell[7];
        $disciple = $cell[8];
        $type = $cell[9];
        echo "<row><teacher>$teacher</teacher><day>$day</day><number>$number</number><auditorium>$auditorium</auditorium><disciple>$disciple</disciple><type>$type</type></row>";
    }
    echo "</root>";
    }catch(PDOException $e){
        echo "Ошибка " . $e->getMessage();

    }
}
?>