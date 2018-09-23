<?php
    require_once 'povezava.php';
    session_start();
    include_once 'check_login.php';
?>
<!DOCTYPE html>

<html>
    <head>
        <title>Ocenjevalec</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="stran.css">
    </head>
    <body>
        <?php
        include_once 'header.php';
        ?>
        <br>
        <?php
        $email=$_GET['email'];
            echo '<span class="prijava">Gledate ocene od '.($_GET['email']).'</span>';
        ?>
        <br>
        <br>
        <?php
            echo '<a href="oceni_zaposleni.php?email='.$email.'" class="gumb">Dodaj oceno</a>';
        ?>
        <br>
        <br>
        <?php
        
        

        $stmt = $pdo->prepare('SELECT *,o.id as id_o from ocene o inner join zaposleni z on o.zaposlen_id=z.id where z.email=?');
        $stmt->execute([$email]);
        
        echo "<table border='1' class='tabla'>
        <tr>
            
            <th>Ocena</th>
            <th>Komentar</th>
            <th>Datum</th>
            <th>Izbriši</th>
        </tr>";
        
            //Here I echo all the members from the database into the table
            foreach ($stmt as $row) {
                echo "<tr>
                        
                        <td>" . $row['ocena'] . "</td>
                        <td>" . $row['komentar'] . "</td>
                        <td>" . $row['datum'] . "</td>
                        <td>".'<a href="brisi_ocena.php?id='.$row['id_o'].'&email='.$row['email'].'" class="gumbtabla">Izbriši</a>'."</td>
                        </tr>";
                        
            }
        
        echo "</table>";
        ?>

        <?php
        include_once 'footer.php';
        ?>
    </body>
</html>
