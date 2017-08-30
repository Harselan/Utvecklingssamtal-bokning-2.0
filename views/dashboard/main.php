<div class="calendar-wrapper">
    <div class="month">
      <ul>
        <li>
          <?= $month['name'] ?><br>
          <span style="font-size:18px"><?= $year ?></span>
        </li>
      </ul>
    </div>
    <table class="calendar" cellspacing = 0>
        <tr class="weekdays">
            <td>Måndag</td>
            <td>Tisdag</td>
            <td>Onsdag</td>
            <td>Torsdag</td>
            <td>Fredag</td>
            <td>Lördag</td>
            <td>Söndag</td>
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
