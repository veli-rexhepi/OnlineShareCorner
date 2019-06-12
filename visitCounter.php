<?php     
    // Only new visits are counted. Refshing the page from same visitor isn't counted.

    // Read data for login
    require "configFiles/loadCredentials.php";

    // Connect to database
    $connVisitCounter = new mysqli($servername, $username, $password, $dbname);    

    // Determine collation to utf8
    $connVisitCounter->set_charset('utf8');
    $connVisitCounter->query("SET collation_connection = utf8_unicode_ci");

    if($connVisitCounter->connect_error) {
    die("No database access! " . $connVisitCounter->connect_error);		
    }
    else {        
        if (!isset($_SESSION['visited'])) {
            // This is the real visit
            $_SESSION['visited'] = TRUE;      

            // Increase counter and update to table
            $sqlVisitCounter = "UPDATE tbl_visitcounter SET visitCounterValue = visitCounterValue + 1 WHERE visitCounterID = 1";			
            $resultVisitCounter = $connVisitCounter->query($sqlVisitCounter);

            // Read counter value and shown on page
            $sqlVisitCounter = "SELECT visitCounterValue from tbl_visitcounter WHERE visitCounterID = 1";			
            $resultVisitCounter = $connVisitCounter->query($sqlVisitCounter);             
            $objVisitCounter = mysqli_fetch_object($resultVisitCounter); 
            $_SESSION['viewCounter'] = $objVisitCounter->visitCounterValue;

            echo "You are visitor number " . $_SESSION['viewCounter'] . ". Thank you for visiting us.";

            $resultVisitCounter->close();				
        }
        else {
            // This is the real visit
            $_SESSION['visited'] = FALSE;

            // Read counter value and shown on page
            $sqlVisitCounter = "SELECT visitCounterValue from tbl_visitcounter WHERE visitCounterID = 1";			
            $resultVisitCounter = $connVisitCounter->query($sqlVisitCounter);             
            $objVisitCounter = mysqli_fetch_object($resultVisitCounter); 
            $_SESSION['viewCounter'] = $objVisitCounter->visitCounterValue;

            echo "You are visitor number " . $_SESSION['viewCounter'] . ". Thank you for visiting us.";	

            $resultVisitCounter->close();
        }             
    }         

    $connVisitCounter->close();
    
    // Clear variable values
    require "configFiles/clearCredentials.php";