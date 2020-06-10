<?php session_start() ?>

<body>
    <div class="login-page">
        <div class="form">
            <form class="register-form" action="?action=register" name="register" method="POST">
                <input type="email" placeholder="email" name="email" value="user1@juleslevassort.com" />
                <input type="text" placeholder="nom + prenom" name="name" />
                <input type="password" placeholder="Mot de passe" name="password" />
                <button type="submit">INSCRIPTION</button>
                <p class="message">J'ai déjà un compte ! <a href="#">Je me connecte</a></p>
            </form>
            <form class="login-form" action="?action=login" name="login" method="POST">
                <input type="text" placeholder="email" name="email" value="user1@juleslevassort.com" />
                <input type="password" placeholder="mot de passe" name="password" />
                <button>CONNEXION</button>
                <p class="message">Je n'ai pas de compte ? <a href="#">Créer un compte</a></p>
            </form>
            <?php if ($_SERVER["REQUEST_METHOD"] === 'POST'): ?>
            <p style="background:red;color:white;padding:8px">
                <?php
                    try {
                        $bdd = new PDO('mysql:host=localhost;dbname=soongles', 'root', '');
                        $bdd->exec('SET NAMES utf8');
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    } catch (PDOException $e) {
                        echo 'ERROR: ' . $e->getMessage();
                    }
                    $action = $_GET['action'];
                    if (isset($action) && !empty($action)) {
                        if ($action == 'login') {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                       
                            if (isset($email) && isset($password) && !empty($email) && !empty($password)) {
                                $req = $bdd->query("SELECT * FROM `users` WHERE email = '$email' LIMIT 1");
                                $result = $req->fetch();
                                if ($result) {
                                    $pass_verif = md5($password);
                                    if ($pass_verif === $result['password']) {
                                        $uid = $result['id'];
                                    $req = $bdd->query("SELECT * FROM `admin` WHERE uid = '$uid' LIMIT 1");
                                    $admin = $req->fetch();


                                    if ($admin){
                                        $_SESSION['user'] = [
                                            'admin' => $result['type'],
                                            'email' => $result['email'],
                                            'nom' => $result['nom'],
                                            'type' => 0
                                        ];

                                        header('location: ../account/manage');
                                        exit();
                                    }
                                        else {

                                        $_SESSION['user'] = [
                                            'email' => $result['email'],
                                            'nom' => $result['nom'],
                                            'type' => 0
                                        ];

                                        header('location: ../account');
                                        exit();

                                        }

                                    } else {
                                        echo "Identifiant ou mot de passe incorrect";
                                    }
                                } else {
                                    echo "Identifiant ou mot de passe incorrect";
                                }
                            } else {
                                echo "Les champs ne sont pas correctement rempli !";
                            }
                        } elseif ($action == 'register') {
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $name = $_POST['name'];
                            if (isset($email, $password, $name) && !empty($email) && !empty($password) && !empty($name)) {
                                $req = $bdd->query("SELECT * FROM `users` WHERE email = '$email' LIMIT 1");
                                $result = $req->fetch();

                                if (!$result) {
                                    $secure_pass = md5($password);
                                    $req = $bdd->prepare("INSERT INTO users (email, nom, password) VALUE(:email, :nom, :password)");
                                    $req->execute([':email' => $email, ':nom' => $name, ':password' => $secure_pass]);

                                    $_SESSION['user'] = [
                                        'email' => $email,
                                        'nom' =>  $_POST['name'],
                                        'type' => 0
                                    ];

                                    header("location: ../account");
                                    exit();
                                } else {
                                    echo "Email déjà enregistré";
                                }
                            } else {
                                echo "Les champs ne sont pas correctement rempli !";
                            }
                        }
                    }
                ?>
            </p>
            <?php endif; ?>
        </div>
        <p>
            Utilisez ces identifiants fictif ou créez vous un compte
            <hr>
            <u> Utilisateur:</u>
            <br><br>
            user1@juleslevassort.com <br>
            azertyuiop
            <br><br>
            <u> admin:</u>
            <br><br>
            admin@juleslevassort.com<br>
            admin1234
        </p>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $('.message a').click(function() {
            $('form').animate({
                height: "toggle",
                opacity: "toggle"
            }, "slow");
        })
    })
    </script>

</body>
<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:300);

.login-page {
    width: 360px;
    padding: 8% 0 0;
    margin: auto;
}

.form {
    position: relative;
    z-index: 1;
    background: #FFFFFF;
    max-width: 360px;
    margin: 0 auto 100px;
    padding: 45px;
    text-align: center;
    box-shadow: 0 0 20px 0 rgb(255, 197, 197, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.14);
    border-radius: 11px;
}

.form input {
    font-family: "Roboto", sans-serif;
    outline: 0;
    background: #f7f7f7;
    width: 100%;
    border: 0;
    margin: 0 0 15px;
    padding: 15px;
    box-sizing: border-box;
    font-size: 14px;
}

.form button {
    font-family: "Roboto", sans-serif;
    text-transform: uppercase;
    outline: 0;
    background: rgb(255, 197, 197, 0.5);
    border-radius: 4px;
    width: 100%;
    border: 0;
    padding: 15px;
    color: #FFFFFF;
    font-size: 14px;
    -webkit-transition: all 0.3 ease;
    transition: all 0.3 ease;
    cursor: pointer;
    transition: 0.4s;
}

.form button:hover,
.form button:active,
.form button:focus {
    transition: 0.4s;
    background: #ffb3b3
}

.form .message {
    margin: 15px 0 0;
    color: #b3b3b3;
    font-size: 12px;
}

.form .message a {
    color: black;
    text-decoration: none;
}

.form .register-form {
    display: none;
}

.container {
    position: relative;
    z-index: 1;
    max-width: 300px;
    margin: 0 auto;
}

.container:before,
.container:after {
    content: "";
    display: block;
    clear: both;
}

.container .info {
    margin: 50px auto;
    text-align: center;
}

.container .info h1 {
    margin: 0 0 15px;
    padding: 0;
    font-size: 36px;
    font-weight: 300;
    color: #1a1a1a;
}

.container .info span {
    color: #4d4d4d;
    font-size: 12px;
}

.container .info span a {
    color: #000000;
    text-decoration: none;
}

.container .info span .fa {
    color: #EF3B3A;
}

body {
    background: #ffe6e67e;
    font-family: "Roboto", sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>