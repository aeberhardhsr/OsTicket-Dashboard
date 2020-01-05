<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title>OsTicket Dashboard</title>
    <link rel='icon' href='favico.ico' type='image/x-icon'/ >


<style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400,700);

body {
    font-family: 'Open Sans', sans-serif;
    font-weight: 300;
    line-height: 1.42em;
    color:#A7A1AE;
    background-color:#1F2739;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 3px solid #1F2739;
    padding-bottom: 1%;
	padding-top: 1%;
    padding-left:1%;
}

table {
    border-collapse: collapse;
    width: 85%;
    margin: 0 auto;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    padding: 0 0 8em 0;
}

tr:nth-child(odd){
    background-color: #323C50;    
}

tr:nth-child(even) {
	background-color: #2C3446;
}

th {
    font-weight: bold;
	font-size: 1.5em;
    text-align: left;
    color: white;
    background: #4DC3FA;
}

h1 {
  font-size:3em; 
  font-weight: 300;
  line-height:1em;
  text-align: center;
  color: #4DC3FA;
}

h2 {
  font-size:1em; 
  font-weight: 300;
  text-align: center;
  display: block;
  line-height:1em;
  padding-bottom: 2em;
  color: #FB667A;
}
p  {
  color: black;
  font-family: Verdana;
  font-size: 160%;
  text-align: center;
  font-style: normal;
}

td {
    font-size: 1.3em;
    color: #f7f5f7
}

</style>
</head>
<body>

<h1>Ticket Dashboard</h1>


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

$sql = "SELECT ost_ticket.number, ost_ticket.lastupdate, ost_ticket__cdata.subject, ost_user.name, ost_ticket_priority.priority, ost_staff.firstname, ost_staff.lastname FROM `ost_ticket` INNER JOIN ost_ticket__cdata ON ost_ticket__cdata.ticket_id = ost_ticket.ticket_id INNER JOIN ost_user ON ost_user.id = ost_ticket.user_id INNER JOIN ost_ticket_priority ON ost_ticket_priority.priority_id = ost_ticket__cdata.priority INNER JOIN ost_staff ON ost_staff.staff_id = ost_ticket.staff_id WHERE closed IS NULL ORDER BY lastupdate DESC";
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