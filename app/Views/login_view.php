<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php echo form_open('login/process_login'); ?>
    <label>Nom d'utilisateur :</label>
    <input type="text" name="username" required />
    <br>
    <label>Mot de passe :</label>
    <input type="password" name="password" required />
    <br>
    <input type="submit" value="Se connecter" />
    <?php echo form_close(); ?>
</body>
</html>
