<div class="logg-wrapper">
    <h1>Tillgängliga arbetsplatser</h1>
    <a href="/places/create" class="link">Lägg till arbetsplats</a>
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Namn</td>
            <td></td>
        </tr>
        <?php foreach($places as $place): ?>
            <tr>
                <td>#<?= $place['id'] ?></td>
                <td><?= $place['name'] ?></td>
                <td><a href="/place/<?= $place['id'] ?>">Läs mer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
