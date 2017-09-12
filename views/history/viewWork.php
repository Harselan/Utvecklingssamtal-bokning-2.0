<div class="logg-wrapper">
    <div class="page-wrapper">

        <?php $minId = $work_times[ count( $work_times ) - 1 ]['id']; if( $page == 1 ): ?>

            <span class="page">Sida <?= $page ?></span>
            <a href="/workhistory/<?= $page + 1 ?>" class="next">&gt;</a>

        <?php elseif( $minId <= 1 ): ?>

            <a href="/workhistory/<?= $page - 1 ?>" class="prev">&lt;</a>
            <span class="page">Sida <?= $page ?></span>

        <?php else: ?>

            <a href="/workhistory/<?= $page - 1 ?>" class="prev">&lt;</a>
            <span class="page">Sida <?= $page ?></span>
            <a href="/workhistory/<?= $page + 1 ?>" class="next">&gt;</a>

        <?php endif; ?>

    </div>
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Logg_id</td>
            <td>Arbetes_id</td>
            <td>Användare</td>
            <td>Arbetsplats</td>
            <td>Start</td>
            <td>Stop</td>
        </tr>
        <?php foreach($work_times as $work): ?>

            <?php if( $work['type_id'] == 1 ): ?>

                <tr>

            <?php elseif( $work['type_id'] == 2 ): ?>

                <tr class="warning">

            <?php endif; ?>
            <td>#<?=$work['id']?></td>
            <td>#<?=$work['history_id']?></td>
            <td>#<?=$work['work_id']?></td>
            <td><?=$work['name']?></td>
            <td><?=$work['workplace']?></td>
            <td><?php echo date( 'H:i', $work['timestart'] )?></td>
            <td><?php echo date( 'H:i', $work['timestop'] )?></td>
            <td><?= $work['message'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
