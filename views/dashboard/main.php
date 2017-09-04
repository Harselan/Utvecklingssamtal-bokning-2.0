<?php if( $cuser['state_id'] == 2 ): ?>
<div class="users-wrapper left">
    <ul>
        <li><h1>Användare</h1></li>
        <?php foreach( $users as $user ): ?>
            <li><a href="account/<?=$user['id']?>"><?=$user['name']?></a></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="calendar-wrapper right">
<?php elseif( $cuser['state_id'] == 1 ): ?>
<div class="calendar-wrapper center">
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
