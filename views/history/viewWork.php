<div class="logg-wrapper">
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Logg_id</td>
            <td>Användar_id</td>
            <td>Arbetes_id</td>
            <td>Användare</td>
            <td>Arbetsplats</td>
            <td>Start</td>
            <td>Stop</td>
            <td>Ändrades</td>
        </tr>
        <?php foreach($work_times as $work): ?>

            <?php if( $work['type_id'] == 1 ): ?>

                <tr>

            <?php elseif( $work['type_id'] == 2 ): ?>

                <tr class="warning">

            <?php endif; ?>
            <td><?=$work['id']?></td>
            <td>#<?=$work['history_id']?></td>
            <td>#<?=$work['user_id']?></td>
            <td>#<?=$work['work_id']?></td>
            <td><?=$work['name']?></td>
            <td><?=$work['workplace']?></td>
            <td><?php echo date( 'Y-m-d', $work['timestart'] )?></td>
            <td><?php echo date( 'Y-m-d', $work['timestop'] )?></td>
            <td><?php echo date( 'Y-m-d', $work['timestamp'] )?></td>
            <td><?= $work['message'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
