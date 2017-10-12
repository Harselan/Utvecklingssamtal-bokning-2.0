<div class="logg-wrapper">
    <h1>Rapporter denna månad</h1>
    <table class="logg">
        <tr class=names>
            <td>Namn</td>
            <td>Arbetstimmar(månad)</td>
            <td></td>
        </tr>
        <?php foreach( $reports as $report): ?>
            <tr>
                <td><?=$report['name']?></td>
                <td><?=round( $report['hours'], 1 )?> timmar</td>
                <td><a href="/reports/<?=$report['user_id']?>">Mer</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
