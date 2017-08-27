<h1>Hej</h1>
<table style="border:1px solid black;" cellspacing = 0;>
    <tr>
        <td style="border:1px solid black;">#</td>
        <td style="border:1px solid black;">Name</td>
        <td style="border:1px solid black;">Password</td>
    </tr>
<?php foreach($users as $user): ?>
    <tr>
        <td style="border:1px solid black;"><?=$user['id']?></td>
        <td style="border:1px solid black;"><?=$user['name']?></td>
        <td style="border:1px solid black;"><?=$user['password']?></td>
    </tr>
<?php endforeach; ?>
</table>
