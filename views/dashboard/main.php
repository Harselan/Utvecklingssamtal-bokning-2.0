<table style="border:1px solid black;" cellspacing = 0;>
<?php foreach($users as $user): ?>
    <tr>
        <td style="border:1px solid black;"><?=$user['name']?></td>
        <td style="border:1px solid black;"><?=$user['pass']?></td>
    </tr>
<?php endforeach; ?>
</table>
