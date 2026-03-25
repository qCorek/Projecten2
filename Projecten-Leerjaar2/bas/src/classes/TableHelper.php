<?php
// auteur: studentnaam
// functie: Helper class voor tabel functies 
namespace Bas\classes;

class TableHelper {
    
    /**
     * Summary of getTableHeader
     * @param array $row
     * @return string
     */
  public static function getTableHeader(array $row) : string {
    $headers = array_keys($row);
    $headerTxt = "<tr>";

    foreach($headers as $header){
        if($header == 'klantId') continue;
        $headerTxt .= "<th>" . $header . "</th>";   
    }

    // extra kolommen voor knoppen
    $headerTxt .= "<th>Wijzig</th>";
    $headerTxt .= "<th>Verwijder</th>";

    $headerTxt .= "</tr>";
    return $headerTxt;
}


}
?>
