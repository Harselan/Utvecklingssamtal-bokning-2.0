<table class="calendar" cellspacing = 0>
    <tr>
        <td>Måndag</td>
        <td>Tisdag</td>
        <td>Onsdag</td>
        <td>Torsdag</td>
        <td>Fredag</td>
        <td>Lördag</td>
        <td>Söndag</td>
    </tr>
    <?php $day = 1; for($w = 1; $w <= $weekamount; $w++): ?>
        <tr>
        <?php for($d = 1; $d <= 7; $d++): ?>
            <?php if( $w == 1 && $d < $connector ): ?>
                <td></td>
            <?php elseif( $day <= $dayamount ): ?>
                <td><?=$day?></td>
                <?php $day++; ?>
            <?php endif; ?>
        <?php endfor; ?>
        </tr>
    <?php endfor; ?>
</table>
<?=$startday?><br>
<?=$dayamount?>
