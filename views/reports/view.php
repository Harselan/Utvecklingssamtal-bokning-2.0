<table class="logg">
    <tr class=names>
        <td>Namn</td>
        <td>Arbetstimmar(månad)</td>
    </tr>
    <?php foreach( $reports as $report): ?>
        <tr>
            <td><?=$report['name']?></td>
            <td><?=round( $report['hours'], 2 )?> timmar</td>
        </tr>
    <?php endforeach; ?>
</table>
