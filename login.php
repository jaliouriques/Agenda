<html lang="en">
<head>
	<meta charset="UTF-8">

    <link rel="stylesheet" href="style.css">

    <title>Login</title>

</head>
<body>
    
    <div class="form-login">

        <form method="post" action="verifica_usuario.php">
            
            <input type="text"     name="nome" placeholder="digite seu nome">
            <br />
            <input type="text"     name="login" placeholder="digite seu login - fulano">
            <br />
            <input type="password" name="senha" placeholder="digite sua senha - 12345">
            <br />
            <input type="submit"   name="login_form" value="acessar">

        </form>

    </div>
    
</body>
</html>