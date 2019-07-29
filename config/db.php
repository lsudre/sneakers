<?php
require ('config/env.php');
class TableRows extends RecursiveIteratorIterator { 
    function __construct($it) { 
        parent::__construct($it, self::LEAVES_ONLY); 
    }

    function current() {
        return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() { 
        echo "<tr>"; 
    } 

    function endChildren() { 
        echo "</tr>" . "\n";
    } 
} 

/* Connexion à une base MySQL avec l'invocation de pilote */
function dbConnect () {
    try {
        $dbh = new PDO(DBHOSTNAME, DBUSER, DBPWD);
    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
}
function dbQuery ($query) {
    $dbh = dbConnect();
    $dbh = new PDO(DBHOSTNAME, DBUSER, DBPWD);
    $dbQuery = $dbh->prepare($query);
    $dbQuery->execute();
}
function getQuery($query){
    $dbh = dbConnect();
    $dbh = new PDO(DBHOSTNAME, DBUSER, DBPWD);
    $dbQuery = $dbh->prepare($query);
    $dbQuery->execute();
    $result = $dbQuery->setFetchMode(PDO::FETCH_ASSOC); 
    // foreach(new TableRows(new RecursiveArrayIterator($dbQuery->fetchAll())) as $k=>$v) { 
    //     echo $v;
    // }
    return $dbQuery->fetchAll(PDO::FETCH_ASSOC);
}
?>