<div class="logg-wrapper">
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Användare</td>
            <td>Arbetsplats</td>
            <td>Datum</td>
            <td>Start</td>
            <td>Stop</td>
            <td>Antal timmar(avrundat)</td>
        </tr>
        <?php foreach($work_times as $work): ?>
            <tr>
                <td><?=$work['id']?></td>
                <td><?=$work['name']?></td>
                <td><?=$work['work']?></td>
                <td><?php echo date('Y-m-d', $work['timestart'])?></td>
                <td><?php echo date( "H:i" , $work['timestart'] ); ?></td>
                <td><?php echo date( "H:i" , $work['timestop'] );?></td>
                <td><?=$work['hours']?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
