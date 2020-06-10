<?php
session_start();

try {
    $bdd = new PDO('mysql:host=localhost;dbname=soongles', 'root', '');
    $bdd->exec('SET NAMES utf8');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
?>

<body>
    <div class="l-site">
        <div class="l-nav">
            <nav class="nav">
                <ul>
                    <li class="nav-primary"><a href="#account">Mon compte</a></li>
                    <li class="nav-primary"><a href="#reservation">Mes réservations</a></li>
                    <li class="nav-primary"><a href="#rdv">Prendre un RDV</a></li>
                    <li class="nav-primary"><a href="../">Retourner sur le site</a></li>
 
                </ul>
            </nav>
        </div>
        <div class="l-page">
            <div class="menu">
                <div class="menu-hamburger"></div>
            </div>
            <section class="band band-a" id="account">
                <div class="band-container">
                    <div class="band-inner">
                        <h1> Bonjour <?= $_SESSION['user']['nom'] ?></h1>
                    </div>
                </div>
            </section>
            <section class="band band-b" id="reservation">
                <div class="band-container">
                    <div class="band-inner">
                        <h1>Mes réservations</h1>
                        <p>
                            Veuillez noter que Sophie peut vous contacter en cas de besoin si l'heure de rdv ne convient pas.
                            <br> Veuillez svp vous présenter au cabinet uniquement le status "<u style="color:green">RDV confirmé</u>" est présent
                        </p>

                        <div class="tbl-header">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <thead>
                                    <tr>
                                        <th>Date du rdv</th>
                                        <th>Etat du rdv</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="tbl-content">
                            <table cellpadding="0" cellspacing="0" border="0">
                                <tbody>
                                    <?php
                                    $req = $bdd->query("SELECT * FROM demande_rdv WHERE email = '" . $_SESSION['user']['email'] . "' ");
                                    while ($row = $req->fetch()) :
                                    ?>
                                        <tr>
                                            <td>
                                                <?= $row['date'] ?>
                                            </td>
                                            <td>
                                                <?= $row['active'] > 0 ? '<u style="color:green">RDV confirmé</u>' : '<u style="color:red">RDV non confirmé</u>' ?>
                                            </td>
                                        </tr>
                                    <?php
                                    endwhile;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <section class="band band-c" id="rdv">
                <div class="band-container">
                    <div class="band-inner" style="width:100%">
                        <h1>Prendre un rdv</h1>
                        <?php
                        if (isset($_GET['date']) && !empty($_GET['date'])) {

                            $week = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
                            $month = ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'octore', 'Novembre', 'Decembre'];
                            $tabDate = explode('-', $_GET['date']);
                            $timestamp = mktime(0, 0, 0, $tabDate[1], $tabDate[2], $tabDate[0]);
                            $jour = date('w', $timestamp);
                            if ($jour == 0) {
                                echo "Sophie ne travaille pas le Dimanche, <br> veuillez essayer un autre jour";
                                echo '<div>
                        <form action="#rdv" method="get" name="show_rdv">
                                <input type="date" class="data_i" name="date">
                                <div>
                                    <button>
                                       Valider
                                    </button>
                                </div>
                                </form>
                        </div>';
                            } else {
                                echo "<h2>Le " . $week[$jour - 1] . " " . $tabDate[2] . " " . $month[$tabDate[1] < 10 ? substr($tabDate[1], 1) - 1 : $tabDate[1] - 1] . "</h2>";
                                echo '<div>
                        <form action="#rdv" method="get" name="show_rdv">
                                <input type="date" value=' . $_GET['date'] . ' class="data_i" name="set_date" style="display:none">
                                <input type="time" class="data_i" name="hour">
                                <div>
                                    <button>
                                       Enregistrer
                                    </button>
                                </div>
                            </form>
                            </div>';
                            }
                        } elseif (isset($_GET['set_date']) && !empty($_GET['set_date']) && isset($_GET['hour']) && !empty($_GET['hour'])) {
                            $req = $bdd->prepare("INSERT INTO demande_rdv (nom, email, date, heure, active) VALUE (:name, :email, :date, :heure, :active)");
                            $req->execute([
                                ':name' => $_SESSION['user']['nom'],
                                ':email' =>  $_SESSION['user']['email'],
                                ':date' => $_GET['set_date'],
                                ':heure' => $_GET['hour'],
                                ':active' => 0
                            ]);
                           echo "<h2>Sophie devra valider votre RDV, un mail de confirmation vous sera adressé</h2>";
                           echo "<p>Enregistrement en cours ... veuillez patienter</p>";
                           echo "<script> setTimeout(() =>{ window.location.href = 'http://localhost/lycee/account/#reservation'}, 3000) </script>";
                        } else {
                            echo '<div>
                        <form action="#rdv" method="get" name="show_rdv">
                                    <input type="date" class="data_i" name="date">
                                    <div>
                                        <button>
                                            Voir les rdv disponible
                                        </button>
                                    </div>
                                </form>
                            </div>';
                            }

                            ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </body>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Open+Sans:700,300,600,800,400);

        table {
            width: 100%;
            table-layout: fixed;
        }

    .tbl-header {
        background-color: rgba(255, 255, 255, 0.3);
    }

    .tbl-content {
        height: 300px;
        overflow-x: auto;
        margin-top: 0px;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    th {
        padding: 20px 15px;
        text-align: left;
        font-weight: 500;
        font-size: 12px;
        color: black;
        text-transform: uppercase;
    }

    td {
        padding: 15px;
        text-align: left;
        vertical-align: middle;
        font-weight: 300;
        font-size: 12px;
        color: black;
        border-bottom: solid 1px rgba(255, 255, 255, 0.1);
    }


    @import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);

    .made-with-love {
        margin-top: 40px;
        padding: 10px;
        clear: left;
        text-align: center;
        font-size: 10px;
        font-family: arial;
        color: #fff;
    }

    .made-with-love i {
        font-style: normal;
        color: #F50057;
        font-size: 14px;
        position: relative;
        top: 2px;
    }

    .made-with-love a {
        color: #fff;
        text-decoration: none;
    }

    .made-with-love a:hover {
        text-decoration: underline;
    }

    ::-webkit-scrollbar {
        width: 6px;
    }

    ::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    ::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
    }

    .data_i {
        height: 48px;
        padding: 12px 24px;
        font-size: 19px;
        border: none;
        border-radius: 4px;
    }

    .band-inner button {
        height: 48px;
        padding: 12px 24px;
        font-size: 19px;
        border: none;
        margin-top: 18px;
        border-radius: 4px;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        background: #ffe6e67e;
        font-family: 'Open Sans', sans-serif;
        scroll-behavior: smooth;
    }

    .l-site {
        margin: 0 auto;
        max-width: 1600px;
        position: relative;
        z-index: 1;
    }

    .l-site:before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 50%;
        display: block;
        z-index: 1;
    }

    .l-page {
        position: relative;
        margin-left: 240px;
        background: #fff;
        z-index: 2;
        box-shadow: 1px 0 25px rgba(0, 0, 0, 0.11);
        -webkit-transition: 0.35s;
        -moz-transition: 0.35s;
        transition: 0.35s;
    }

    .l-nav {
        position: absolute;
        width: 240px;
        display: block;
        background: rgb(255, 197, 197, .7);
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 3;
    }

    .band h1 {
        margin: 0;
        padding: 0 0 10px;
        color: #fff;
        font-size: 32px;
    }

    .band p {
        margin: 0;
        padding: 0;
        color: #fff;
        font-size: 17px;
    }

    .band-container {
        left: 0;
        right: 0;
        margin: 0 auto;
        min-height: 85vh;
        max-width: 960px;
        display: table;
        position: relative;
        padding: 0 3em;
    }

    .band-inner {
        display: table-cell;
        vertical-align: middle;
        padding: 3em 0 4em;
    }

    .band-a {
        background: #69D2E7;
    }

    .band-b {
        background: #F9D423;
    }

    .band-c {
        background: #F38630;
    }

    .band-d {
        background: #FF4E50;
    }

    .nav {
        width: 180px;
        position: fixed;
        top: 0;
        bottom: 0;
        margin: 0;
        padding: 30px;
        overflow: auto;
    }

    .nav ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .nav li {
        margin: 0;
        padding: 0;
        -webkit-transition: 0.25s;
        -moz-transition: 0.25s;
        transition: 0.25s;
    }

    .nav a {
        color: #fff;
        text-decoration: none;
        font-size: 20px;
        font-weight: 800;
        display: block;
        padding: 10px 0;
    }

    .nav .nav-primary {
        opacity: 1;
    }

    .nav .nav-primary:hover {
        opacity: 0.7;
    }

    .nav .nav-secondary {
        opacity: 0.4;
    }

    .nav .nav-secondary:hover {
        opacity: 0.7;
    }

    .menu {
        display: none;
        position: fixed;
        top: 25px;
        left: 1.5em;
        width: 24px;
        height: 24px;
        cursor: pointer;
        z-index: 10;
    }

    .menu:hover .menu-hamburger:before,
    .menu:hover .menu-hamburger:after {
        width: 24px;
    }

    .menu.is-active .menu-hamburger {
        background: none;
    }

    .menu.is-active .menu-hamburger:before,
    .menu.is-active .menu-hamburger:after {
        top: 0;
        width: 24px;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }

    .menu.is-active .menu-hamburger:after {
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }

    .menu.is-active .menu-hamburger:hover {
        -webkit-transform: scale(1.2);
        -ms-transform: scale(1.2);
        transform: scale(1.2);
    }

    .menu-hamburger {
        position: relative;
        width: 24px;
        height: 4px;
        margin: 10px 0;
        background: #fff;
        border-radius: 4px;
        transition: all 300ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .menu-hamburger:before,
    .menu-hamburger:after {
        content: '';
        display: block;
        width: 24px;
        height: 4px;
        background: #fff;
        position: absolute;
        border-radius: 4px;
        transition: all 300ms cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }

    .menu-hamburger:before {
        top: -8px;
        left: 0;
        width: 22px;
    }

    .menu-hamburger:after {
        top: 8px;
        width: 16px;
        left: 0;
    }

    @media screen and (max-width: 980px) {
        .menu {
            display: block;
        }

        .l-site.is-open {
            overflow: hidden;
        }

        .l-site.is-open .l-page {
            -webkit-transform: translateX(240px);
            -moz-transform: translateX(240px);
            -ms-transform: translateX(240px);
            -o-transform: translateX(240px);
            transform: translateX(240px);
        }

        .l-page {
            margin-left: 0;
            z-index: 3;
        }

        .l-nav {
            z-index: 2;
        }

        .band-container {
            padding: 0 1.5em;
        }
    }
</style>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
</script>

<script>
    $('.menu').on('click', function() {
        if ($('.l-site').hasClass('is-open')) {
            $('.menu').removeClass('is-active');
            $('.l-site').removeClass('is-open');
        } else {
            $('.menu').addClass('is-active');
            $('.l-site').addClass('is-open');
        }
    });
</script>