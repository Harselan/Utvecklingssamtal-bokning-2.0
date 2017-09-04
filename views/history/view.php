<div class="logg-wrapper">
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Användar_id</td>
            <td>Användare</td>
            <td>Tidpunkt</td>
            <td>Meddelande</td>
        </tr>
        <?php foreach($work_times as $work): ?>

            <?php if( $work['type_id'] == 1 ): ?>

                <tr>

            <?php elseif( $work['type_id'] == 2 ): ?>

                <tr class="warning">

            <?php endif; ?>
            <td>#<?=$work['id']?></td>
            <td>#<?=$work['user_id']?></td>
            <td><?=$work['name']?></td>
            <td><?php echo date( 'Y-m-d h:i:s', $work['timestamp'] )?></td>
            <td><?= $work['message'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
