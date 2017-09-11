<div class="logg-wrapper">
    <div class="page-wrapper">

        <?php $minId = $work_times[ count( $work_times ) - 1 ]['id']; if( $page == 1 ): ?>

            <span class="page">Sida <?= $page ?></span>
            <a href="/history/<?= $page + 1 ?>" class="next">&gt;</a>

        <?php elseif( $minId <= 1 ): ?>

            <a href="/history/<?= $page - 1 ?>" class="prev">&lt;</a>
            <span class="page">Sida <?= $page ?></span>

        <?php else: ?>

            <a href="/history/<?= $page - 1 ?>" class="prev">&lt;</a>
            <span class="page">Sida <?= $page ?></span>
            <a href="/history/<?= $page + 1 ?>" class="next">&gt;</a>

        <?php endif; ?>

    </div>
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
            <td><?php echo date( 'Y-m-d H:i:s', $work['timestamp'] )?></td>
            <td><?= $work['message'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
