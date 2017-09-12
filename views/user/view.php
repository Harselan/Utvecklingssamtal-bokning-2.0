<div class="user-info">
    <h3>Namn: <span><?= $user['name'] ?></span></h3>
    <h3>Antal timmar denna vecka: <span><?php if( !empty($week_hour[0]['workhours']) ): echo $week_hour[0]['workhours']; else: echo 0; endif;?> timmar</span></h3>
    <h3>Antal timmar denna Månad: <span><?php if( !empty($month_hour[0]['workhours']) ): echo $month_hour[0]['workhours']; else: echo 0; endif;?> timmar</span></h3>
    <?php if( User::get( $_SESSION['user_id'] )['state_id'] == 2 ): ?>
    <form action="/account/<?= $user['id'] ?>/change" method="post">
        <select name="state_id">
            <option disabled="disabled">Status</option>
            <?php foreach( $states as $state ): ?>
                <?php if( $state['id'] == $user['state_id'] ): ?>
                    <option value="<?= $state['id'] ?>" selected><?= $state['state'] ?></option>
                <?php else: ?>
                    <option value="<?= $state['id'] ?>"><?= $state['state'] ?></option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Ändra status">
    </form>
    <?php endif; ?>
</div>
<div class="logg-wrapper">

    <h1>Loggade arbeten</h1>
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Arbetsplats</td>
            <td class="compOnly">Datum</td>
            <td>Start</td>
            <td>Stop</td>
            <td class="compOnly">Antal timmar(avrundat)</td>
            <td></td>
        </tr>
        <?php foreach( $work_data as $data ): ?>
            <tr>
                <td>#<?= $data['id'] ?></td>
                <td><?= $data['work'] ?></td>
                <td class="compOnly"><?php echo date( 'Y-m-d', $data['timestart'] ); ?></td>
                <td><?php echo date( 'H:i', $data['timestart'] )?></td>
                <td><?php echo date( 'H:i', $data['timestop'] )?></td>
                <td class="compOnly"><?= $data['hours'] ?></td>
                <td><a href="/work/edit/<?=$data['id']?>">Ändra arbetslogg</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
