<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table, thead, tbody, tr,td,th {
            border: solid 1px black;
            overflow: hidden;
        }
    </style>
    <title>prehled knih</title>
</head>
<body>
<div class="nav">
    <a href="./vkladani.php">Vkladani knih</a>
    <a href="./vyhledavani.php">Vyhledevani knih</a>
    </div>
    <h2>Prehled knih</h2>
    <?php 
        include("dbLogin.php");
        if (!($con = mysqli_connect($host,$user,$password, $db))){
            die("Nelze se pripojit k db serveru</body></html>");
        } 
        mysqli_query($con,"SET NAMES 'utf8'");
        if(!($vysledek = mysqli_query($con, "SELECT nazev_knihy, ISBN, jmeno, prijmeni,popis FROM knihy"))) {
            die("Nelze provést dotaz</body></html>");
        }
        ?>
        <table>
            <thead>
                <tr>
                    <th>Nazev knihy</th>
                    <th>ISBN</th>
                    <th>Jmeno autora</th>
                    <th>Prijmeni autora</th>
                    <th>Popis</th>
                </tr>
            </thead>
            <tbody>
        <?php
            while ($radek = mysqli_fetch_array($vysledek)) {
            ?>
                <tr>
                    <td><?php echo $radek["nazev_knihy"] ?></td>
                    <td><?php echo $radek["ISBN"] ?></td>
                    <td><?php echo $radek["jmeno"] ?></td>
                    <td><?php echo $radek["prijmeni"] ?></td>
                    <td><?php echo $radek["popis"] ?></td>
                </tr>
            <?php
            }
            ?>
            </tbody>
            </table>
            <?php
            mysqli_free_result($vysledek);
            mysqli_close($con);
    ?>
</body>
</html>