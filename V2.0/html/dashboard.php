<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<link rel="stylesheet" type="text/css" href="../css/dashboard.css" />
<link href="https://fonts.googleapis.com/css?family=Quicksand:300,500" rel="stylesheet">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <h1>Dashboard OS Ticket</h1>
        </div>
        <div id="leftcolumn">

            <div id="leftcolumn-box">
                <div class="block color">
                <div>
                <?php
                        $servername = "localhost";
                        $username = "pma";
                        $password = "pma";
                        $dbname = "ost";
                        
                        // Create connection
                        $conn = new mysqli($servername, $username, $password, $dbname);
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        
                        $sql = "SELECT COUNT(ost_ticket.number) FROM `ost_ticket` WHERE closed IS NULL ORDER BY lastupdate DESC";
                        $res = $conn->query($sql);
                        $result = mysqli_fetch_array($res);                        
                        $conn->close();
                    ?>
                </div>
                    <div class="heading-box">
                      Offene Tickets
                    </div>
                    <div class="num"><?php echo $result[0]; ?></div>
                  </div>
                  
            </div>

            

            <div id="leftcolumn-box">
                <div class="block color">
                    <div class="heading-box">
                        Gelöst diese Woche
                    </div>
                    <div class="num">5</div>
                  </div>
            </div>

            

            <div id="leftcolumn-box">
                <div class="block color">
                    <div class="heading-box">
                        Gelöst letzte Woche
                    </div>
                    <div class="num">12</div>
                  </div>
            </div>

        </div>
        <div id="ticket-view">
           <div id="ticket-table">
            <?php
            $servername = "localhost";
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

           </div>
       </div>
    </div>
</body>
</html>
