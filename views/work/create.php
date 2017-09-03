<div class="form-wrapper center">
    <h1>Lägg till arbetstid på <?= $date ?></h1>
    <form action="/date/<?=$date?>/create" method="post">
        <select name="workplace" required>
            <option selected="true" disabled="disabled">Arbetsplats</option>
            <?php foreach($workplace as $work): ?>
            <option value="<?= $work['id'] ?>"><?= $work['name'] ?></option>
            <?php endforeach; ?>
        </select><br>
        <h3>Från:</h3> <input type="text" name="from" placeholder="HH:MM" required><br>
        <h3>Till:</h3> <input type="text" name="to" placeholder="HH:MM" required>
        <input type="submit" value="Lägg till arbetstid">
    </form>
</div>
