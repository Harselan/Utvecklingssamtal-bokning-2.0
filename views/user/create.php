<?php if( $error == 1 ): ?>
    <div class="warning">
        <h2><?= $message ?></h2>
    </div>
<?php endif; ?>
<div class="form-wrapper center">
    <h1>Skapa en ny användare</h1>
    <form action="/account/create" method="post">
        <input type="text" name="name" placeholder="Användarnamn:" required>
        <input type="text" name="password" placeholder="Lösenord:" required>
        <select name="state_id" required>
            <option disabled="disabled" selected>Användartyp</option>
            <?php foreach( $states as $state ): ?>
                <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Skapa användare">
    </form>
</div>
