<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        form{
            margin-left:10px;
            padding-bottom:5px;
            display:block;
        }
        .btn{
            margin-left:300px;
        }

    </style>
    <title>vkladani knih</title>
</head>
<body>
    <div class="nav">
    <a href="./prehled.php">Prehled knih</a>
    <a href="./vyhledavani.php">Vyhledevani knih</a>
    </div>
    <h2>Vlozeni nove knihy</h2>
    <form method="POST" action="vkladani.php">
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
            <tr>
                <th>Popis:</th>
                <td><textarea name="popis"cols="30" rows="10"></textarea></td>
            </tr>
        </table>
        <input type="hidden" name="id_knihy">
        <input class="btn" type="submit" value="Vloz">
    </form>
    <?php 
    include("dbLogin.php");
    if (!($con = mysqli_connect($host,$user,$password, $db))){
        die("Nelze se pripojit k db serveru</body></html>");
    }
    if(isset($_POST["ISBN"]) && isset($_POST["jmeno"]) && isset($_POST["prijmeni"])&& isset($_POST["nazev_knihy"])){
        mysqli_query($con,"SET NAMES 'utf8'");
        if(mysqli_query($con,"INSERT INTO knihy(id_knihy, ISBN, jmeno, prijmeni, nazev_knihy, popis) VALUES ('".
            addslashes($_POST["id_knihy"]) . "', '" .
            addslashes($_POST["ISBN"]) . "', '" .
            addslashes($_POST["jmeno"]) . "', '" .
            addslashes($_POST["prijmeni"]) . "', '" .
            addslashes($_POST["nazev_knihy"]) . "', '" .
            addslashes($_POST["popis"]) . "')")) {
            echo"úspěšně vloženo";
    } else {
            echo"nelze provést dotaz" . mysqli_error($con);
    }
        mysqli_close($con); 
    }
?>  
</body>
</html>