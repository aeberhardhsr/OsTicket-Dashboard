<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/3/w3.css">
<head>
    <title>OsTicket Dashboard</title>
    <link rel='icon' href='favico.ico' type='image/x-icon'/ >


<style>
th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table {
    border-collapse: collapse;
    width: 80%;
    margin: 0 auto;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #4a69bb;
    color: white;
}

h2 {
  color: black;
  font-family: verdana;
  font-size: 250%;
  text-align: center;
  
}
p  {
  color: black;
  font-family: Verdana;
  font-size: 160%;
  text-align: center;
  font-style: normal;
}
  #demoFont {
font-family: Impact, Charcoal, sans-serif;
font-size: 25px;
letter-spacing: 1px;
word-spacing: 0.8px;
color: #000000;
font-weight: 400;
text-decoration: overline solid rgb(68, 68, 68);
font-style: normal;
font-variant: small-caps;
text-transform: capitalize;
text-align: center;
}

img {
  width: 25%; 
  height: auto;
  display: block;
  margin-left: auto;
  margin-right: auto;
}


</style>
</head>
<body>

<h2>Wild&Küpfer AG</h2>
    <p><i>Dashboard</i></p>


<span style="display:inline-block; width: 10px;"></span>

<?php
$servername = "10.10.11.68";
$username = "pma";
$password = "pma";
$dbname = "ost";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT ost_ticket.number, DATE_FORMAT(lastupdate, '%d.%m.%Y'), ost_ticket__cdata.subject, ost_user.name, ost_ticket_priority.priority, ost_staff.firstname, ost_staff.lastname FROM `ost_ticket` INNER JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id = ost_ticket.ticket_id INNER JOIN ost_user ON ost_user.id = ost_ticket.user_id INNER JOIN ost_ticket_priority ON ost_ticket_priority.priority_id = ost_ticket__cdata.priority INNER JOIN ost_staff ON ost_staff.staff_id = ost_ticket.staff_id WHERE closed IS NULL ORDER BY lastupdate DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>Ticket Nummer</th><th>Zuletzt geändert</th><th>Betreff</th><th>Eröffnet von</th><th>Priorität</th><th>Zuständig</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["number"]. "</td><td>" . $row["lastupdate"]. "</td><td>" . $row["subject"]. "</td><td>" . $row["name"]. "</td><td>" . $row["priority"]. "</td><td>" . $row["firstname"]. " " . $row["lastname"]. "</td></tr>";
    }
    echo "</table>";
} else {
    //echo "0 results";
}

$conn->close();
?>



<span style="display:inline-block; height: 20px;"></span>

</body>
</html>