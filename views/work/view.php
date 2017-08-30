<div class="form-wrapper center">
    <h1 class="form-header">Lägg till arbetstid på <?= $date ?></h1>
    <form action="/date/<?=$date?>/create" method="post">
        <select class="form-input" name="workplace">
            <option selected="true" disabled="disabled">Arbetsplats</option>
            <?php foreach($workplace as $work): ?>
            <option value="<?= $work['id'] ?>"><?= $work['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        Från: <input class="form-input" type="text" name="from" placeholder="HH:MM"><br>
        Till: <input class="form-input" type="text" name="to" placeholder="HH:MM">
        <input type="submit" class="form-submit" value="Lägg till arbetstid">
    </form>
</div>
