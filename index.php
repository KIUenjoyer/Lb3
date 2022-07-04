<!DOCTYPE HTML>
<html>

<head>
    <title>ЛБ3</title>
    <script>
        var ajax = new XMLHttpRequest();
        function _button1() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        console.dir(ajax.responseText);
                        document.getElementById("result").innerHTML = ajax.response;
                    }
                }
            }
            var group = document.getElementById("groups").value;
            ajax.open("get", "action1.php?groups=" + group);
            ajax.send();
        }

        function _button2() {
            ajax.onreadystatechange = function() {
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {

                        console.dir(ajax);
                        let rows = ajax.responseXML.firstChild.children;
                        let result = "<table border ='1'>";
                        result += "<tr><th>Teacher</th><th>Day</th><th>Number</th><th>Auditorium</th><th>Disciple</th><th>Type</th></tr>";
                        for (var i = 0; i < rows.length; i++) {
                            result += "<tr>";
                            result += "<td>" + rows[i].children[0].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[1].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[2].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[3].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[4].firstChild.nodeValue + "</td>";
                            result += "<td>" + rows[i].children[5].firstChild.nodeValue + "</td>";
                            result += "</tr>";
                        }
                        result += "</table>";
                        document.getElementById("result").innerHTML = result;
                    }
                }
            }
            var teacher = document.getElementById("teachers").value;
            ajax.open("get", "action2.php?teachers=" + teacher);
            ajax.send();
        }

        function _button3() {
            ajax.onreadystatechange = function() {
                let rows = JSON.parse(ajax.responseText);
                console.dir(rows);
                if (ajax.readyState === 4) {
                    if (ajax.status === 200) {
                        console.dir(ajax);

                        let result = "<table border ='1'>";
                        result += "<tr><th>Auditorium</th><th>Day</th><th>Number</th><th>Disciple</th><th>Type</th></tr>";
                        for (var i = 0; i < rows.length; i++) {
                            result += "<tr>";
                            result += "<td>" + rows[i].auditorium + "</td>";
                            result += "<td>" + rows[i].week_day + "</td>";
                            result += "<td>" + rows[i].lesson_number + "</td>";
                            result += "<td>" + rows[i].disciple + "</td>";
                            result += "<td>" + rows[i].type + "</td>";
                            result += "</tr>";
                        }
                        document.getElementById("result").innerHTML = result;
                    }
                }
            };
            var auditorium = document.getElementById("auditorium").value;
            ajax.open("get", "action3.php?auditorium=" + auditorium);
            ajax.send();
        }
    </script>
</head>

<body>
    <h3>Алейник Д.С. КІУКІ-19-1, Вар №1</h3>
    <p><strong> Вывести расписание занятий группы </strong>
        <select name="groups" id="groups">
            <option>Группа</option>
            <?php
                include "connection.php";
                $sqlSelect = "SELECT * FROM $db.groups";
                foreach ($dbh->query($sqlSelect) as $cell) {
                    echo "<option>$cell[1]</option>";
                }
            ?>
        </select>
        <input type="submit" value="ok" onclick="_button1()">
    </p>
    <p><strong>Вывести расписание преподавателя</strong>
        <select name="teachers" id="teachers">
            <option>Преподаватели</option>
            <?php
                $sqlSelect = "SELECT * FROM $db.teacher";

                foreach ($dbh->query($sqlSelect) as $cell) {
                    echo "<option>$cell[1]</option>";
                }
            ?>
        </select>
        <input type="submit" value="ok" onclick="_button2()">
    </p>
    <p><strong>Вывести расписание для аудитории</strong>
        <select name="auditorium" id="auditorium">
            <option>Аудитория</option>
            <?php
                $sqlSelect = "SELECT DISTINCT auditorium FROM $db.lesson";
                foreach ($dbh->query($sqlSelect) as $cell) {
                    echo "<option>$cell[0]</option>";
                }
            ?>
        </select>
        <input type="submit" value="ok" onclick="_button3()">
    </p>
<div id="result"></div>
</body>

</html>