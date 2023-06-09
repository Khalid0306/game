<?php

    require_once('functions.php');

    if (isset($_POST["send"])) {
        $bdd = connect();
        $sql = "SELECT * FROM users WHERE `email` = :email;";
        
        $sth = $bdd->prepare($sql);
        
        $sth->execute([
            'email'     => $_POST['email']
        ]);

        $user = $sth->fetch();
        
        if ($user && password_verify($_POST['password'], $user['password']) ) {
            // dd($user);
            $_SESSION['user'] = $user;
            header('Location: persos.php');
        } else {
            $msg = "Incorrect email or password !";
        }
    }
?>
<?php require_once('_header.php'); ?>
    <form action="" method="post">
        <h1>Welcome back !</h1>

        <?php if (isset($msg)) { echo "<div>" . $msg . "</div>"; } ?>

        <div>
            <label for="email">Email</label>
            <input 
                type="email" 
                placeholder="Enter your email" 
                name="email" 
                id="email" 
            />
        </div>
        <div>
            <label for="password">Password</label>
            <input 
                type="password" 
                placeholder="Enter your password" 
                name="password" 
                id="password" 
            />
        </div>
        <div>
            <input type="submit" class="btn btn-green" name="send" value="Log in" />
        </div>
    </form>
</body>
</html>

