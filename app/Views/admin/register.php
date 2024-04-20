<style>
    label, input {
        display: block;
        margin: 5px 0;
    }
    input[type="text"], input[type="password"] {
        width: 200px;
        padding: 5px;
    }
    input[type="submit"] {
        padding: 5px 15px;
        cursor: pointer;
    }
    .message {
        color: green;
    }
    .error {
        color: red;
    }
</style>
<h1>Register Admin</h1>
<?php if (session()->getFlashdata('error')): ?>
    <div class="error">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('success')): ?>
    <div class="message">
        <?= session()->getFlashdata('success'); ?>
    </div>
<?php endif; ?>
<form method="post" action="<?= base_url('admin/register_validation'); ?>">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required>
    <label for="prenom">Prénom:</label>
    <input type="text" id="prenom" name="prenom" required>
    <label for="mail">Email:</label>
    <input type="text" id="mail" name="mail" required> <!-- Updated to "mail" to match your database column -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <input type="submit" value="Register">
</form>