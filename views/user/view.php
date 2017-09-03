<div class="user-info">
    <h3>Namn:<span><?= $_SESSION['name'] ?></span></h3>
    <h3>Antal timmar denna vecka: <span><?php if( !empty($week_hour[0]['workhours']) ): echo $week_hour[0]['workhours']; else: echo 0; endif;?> timmar</span></h3>
    <h3>Antal timmar denna Månad: <span><?php if( !empty($month_hour[0]['workhours']) ): echo $month_hour[0]['workhours']; else: echo 0; endif;?> timmar</span></h3>
</div>

<div class="logg-wrapper">

    <h1>Loggade arbeten</h1>
    <table class="logg" cellspacing = 0>
        <tr class="names">
            <td>#</td>
            <td>Arbetsplats</td>
            <td>Datum</td>
            <td>Start</td>
            <td>Stop</td>
            <td>Antal timmar(avrundat)</td>
            <td></td>
        </tr>
        <?php foreach( $work_data as $data ): ?>
            <tr>
                <td><?= $data['id'] ?></td>
                <td><?= $data['work'] ?></td>
                <td><?php echo date( 'Y-m-d', $data['timestart'] ); ?></td>
                <td><?php echo date( 'H:i', $data['timestart'] )?></td>
                <td><?php echo date( 'H:i', $data['timestop'] )?></td>
                <td><?= $data['hours'] ?></td>
                <td><a href="/work/edit/<?=$data['id']?>">Ändra arbetslogg</a></td>
            </tr>
        <?php endforeach; ?>
    </table>

</div>
