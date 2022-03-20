<?php
 $datafile = "governors-general";

// if selection has been made, find a match

 if (isset ($_POST['viceregent'])) {
    $viceregent = htmlentities ($_POST['viceregent']);
    $DB = fopen ($datafile, 'r') or die ("$datafile cannot be opened for reading.");

    $found = FALSE;
    while ($record = fgets ($DB) and ! $found) {
       $field = explode (",", htmlentities (trim ($record)));
       $found = $viceregent === $field[0];
    }

    fclose ($DB);

    if ($found) {
       echo "<p>$field[1] was the $field[2] Governor General of Canada. $field[0] served from $field[3] to $field[4] and contributed the $field[5].</p>\n";
    }
 }

// Generate the form

 echo "<form method=\"post\" action=\"viceregal.php\">\n";
 echo " Select a Governor General: <select name=\"viceregent\">\n";

 $DB = fopen ($datafile, 'r') or die ("$datafile cannot be opened for reading.");
 while ($record = fgets ($DB) ) {
    $field = explode (",", htmlentities (trim ($record)));
    echo "   <option value=\"$field[0]\">$field[1]</option>\n";
 }
 fclose ($DB);

 echo " </select>\n";
 echo " <input type=\"submit\">\n";
 echo "</form>\n";
?>