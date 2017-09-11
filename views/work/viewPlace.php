<div class="user-info">
    <h3>Arbetsplats: <?= $place['name'] ?></h3>
    <h3><a href="/place/<?= $place['id'] ?>/change">Ändra</a></h3>
    <h3><a href="/place/<?= $place['id'] ?>/delete" class="erase">Ta bort</a></h3>
</div>


<div class="logg-wrapper">
    <h1>Alla arbeten från platsen <?= $place['name'] ?></h1>
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Datum</td>
            <td>Start</td>
            <td>Stop</td>
            <td>Antal timmar(avrundat)</td>
            <td></td>
        </tr>
        <?php foreach( $work_times as $data ): ?>
            <tr>
                <td>#<?= $data['id'] ?></td>
                <td><?php echo date( 'Y-m-d', $data['timestart'] ); ?></td>
                <td><?php echo date( 'H:i', $data['timestart'] )?></td>
                <td><?php echo date( 'H:i', $data['timestop'] )?></td>
                <td><?= $data['hours'] ?></td>
                <td><a href="/work/edit/<?=$data['id']?>">Ändra arbetslogg</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
