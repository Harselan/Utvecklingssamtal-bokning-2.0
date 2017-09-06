<?php if( $cuser == 2 ): ?>
<div class="users-wrapper left">
    <ul>
        <li><h1>Användare</h1></li>
        <li><a href="account/create" class="create">Skapa användare</a></li>
        <?php foreach( $users as $user ): ?>
            <li><a href="account/<?=$user['id']?>"><?=$user['name']?> - <?=$user['state']?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="calendar-wrapper calendar-admin right">
<?php elseif( $cuser == 1 ): ?>
<div class="calendar-wrapper calendar-user center">
<?php endif; ?>
    <div class="month">
      <?= $month['name'] ?><br>
      <span style="font-size:18px"><?= $year ?></span>
    </div>
    <table class="calendar" cellspacing = 0>
        <tr class="weekdays">
            <td><span>Måndag</span></td>
            <td><span>Tisdag</span></td>
            <td><span>Onsdag</span></td>
            <td><span>Torsdag</span></td>
            <td><span>Fredag</span></td>
            <td><span>Lördag</span></td>
            <td><span>Söndag</span></td>
        </tr>
        <?php $day = 1; for($w = 1; $w <= $weekamount; $w++): ?>
            <tr class="days">
            <?php for($d = 1; $d <= 7; $d++): ?>
                <?php if( $w == 1 && $d < $connector || $day > $dayamount ): ?>
                    <td></td>
                <?php elseif( $day <= $dayamount ): ?>
                    <td><a href="date/<?php echo $year . '/' . $month['date'] . '/' . $day; ?>" ><?=$day?></a></td>
                    <?php $day++; ?>
                <?php endif; ?>
            <?php endfor; ?>
            </tr>
        <?php endfor; ?>
</table>
</div>
