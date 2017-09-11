<?php if( $error == 1 ): ?>
    <div class="warning">
        <h2><?= $message ?></h2>
    </div>
<?php endif; ?>
<div class="form-wrapper center">
    <h1>Skapa arbetsplats</h1>
    <form action="/places/create" method="post">
        <input type="text" name="name" placeholder="Namn:">
        <input type="submit" value="Lägg till arbetsplats">
    </form>
</div>
