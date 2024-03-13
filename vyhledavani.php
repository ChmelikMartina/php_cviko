<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .btn{
            margin-left:240px;
        }

    </style>
    <title>vyhledavani knih</title>
</head>
<body>
    <div class="nav">
        <a href="./prehled.php">Prehled knih</a>
        <a href="./vkladani.php">Vkladani knih</a>
    </div>
    <h2>Vyhledavani knih</h2>
    <form action="vyhledavani.php" method="POST">
        <table>
            <tr>
                <th>Jmeno autora:</th>
                <td><input type="text" name="jmeno"></td>
            </tr>
            <tr>
                <th>Prijmeni autora:</th>
                <td><input type="text" name="prijmeni"></td>
            </tr>
            <tr>
                <th>Nazev knihy:</th>
                <td><input type="text" name="nazev_knihy"></td>
            </tr>
            <tr>
                <th>ISBN:</th>
                <td><input type="text" name="ISBN"></td>
            </tr>
        </table>
        <input class="btn" type="submit" value="Hledej">
    </form>
    <?php 
        
        include("dbLogin.php");
        if (!($con = mysqli_connect($host,$user,$password, $db))){
            die("Nelze se pripojit k db serveru</body></html>");
        }

        if(isset($_POST["jmeno"])&& isset($_POST["prijmeni"])&& isset($_POST["ISBN"])&& isset($_POST["nazev_knihy"])){
            $jmeno=htmlspecialchars($_POST["jmeno"]);
            $prijmeni=htmlspecialchars($_POST["prijmeni"]);
            $isbn=htmlspecialchars($_POST["ISBN"]);
            $nazev=htmlspecialchars($_POST["nazev_knihy"]);
            mysqli_query($con,"SET NAMES 'utf8'");

            $dotaz = "SELECT * FROM knihy WHERE 1=1";
            if($jmeno!=""){
                $dotaz.=" AND jmeno='".$jmeno."'";
            }
            if($prijmeni!=""){
                $dotaz.=" AND prijmeni='".$prijmeni."'";
            }
            if($isbn!=""){
                $dotaz.=" AND ISBN='".$isbn."'";
            }
            if($nazev!=""){
                $dotaz.=" AND nazev_knihy='".$nazev."'";
            }
            // echo $dotaz;
            if(!($vysledek = mysqli_query($con,$dotaz))) {
            die("Nelze provést dotaz</body></html>");
            }
            ?>
            <h3>Vysledek vyhledavani</h3>
            <table>
                <thead>
                    <tr>
                        <th>Nazev knihy</th>
                        <th>ISBN</th>
                        <th>Jmeno autora</th>
                        <th>Prijmeni autora</th>
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
            mysqli_free_result($vysledek);
            mysqli_close($con);
            ?>
            </tbody>
            </table>
            <?php
            
    }        
    ?> 
</body>            
</html>