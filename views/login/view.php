<?php if( $error == 1 && isset( $message ) ): ?>
    <div class="warning">
        <h2><?= $message ?></h2>
    </div>
<?php endif; ?>
<div class="login-wrapper">
    <h1>Vänligen logga in</h1>
    <form action="/login" method="post">
    <label>Namn</label><input type="text" name="name" required>
    <label>Lösenord</label><input type="password" name="password" required>
    <input type="submit" value="Logga in">
    </form>
</div>
