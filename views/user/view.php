<h1><?=$_SESSION['name']?></h1>
<h1>Antalet timmar denna vecka: <?=$week_hour[0]['workhours']?> timmar</h1>
<h1>Antalet timmar denna Månad: <?=$month_hour[0]['workhours']?> timmar</h1>

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
