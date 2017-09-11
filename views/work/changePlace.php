<?php if( $error == 1 ): ?>
    <div class="warning">
        <h2><?= $message ?></h2>
    </div>
<?php endif; ?>
<div class="form-wrapper center">
    <h1>Ändra arbetsplatsen</h1>
    <form action="/place/<?= $place['id'] ?>/change" method="post">
        <input type="text" name="name" value="<?= $place['name'] ?>" placeholder="Namn:">
        <input type="submit" value="Ändra">
    </form>
</div>
