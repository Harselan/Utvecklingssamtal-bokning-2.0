<div class="logg-wrapper">
    <h1>Rapport denna månad för <?=$reports[0]['name']?></h1>
    <table class="logg">
        <tr class=names>
            <td>Plats</td>
            <td>Namn</td>
            <td>Arbetstimmar</td>
        </tr>
        <?php foreach( $reports as $report): ?>
            <tr>
                <td><?=$report['work']?></td>
                <td><?=$report['name']?></td>
                <td><?=$report['hours']?> timmar</td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
