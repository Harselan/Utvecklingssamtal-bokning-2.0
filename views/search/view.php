<div class="search-result">
    <h1>Din sökning på "<?=$search?>" gav <?=count( $data['works'] ) + count( $data['users'] )?> träffar</h1>
    <h1>Sökträffar på arbetsloggen <span>(<?=count( $data['works'] )?>)</span>st</h1>
    <table class="logg">
        <tr class="names">
            <td>#</td>
            <td>Användar_id</td>
            <td>Arbetes_id</td>
            <td>Användare</td>
            <td>Start</td>
            <td>Stop</td>
        </tr>
        <?php foreach( $data['works'] as $work ): ?>
        <tr>
            <td><?=$work['id']?></td>
            <td>#<?=$work['work_id']?></td>
            <td>#<?=$work['user_id']?></td>
            <td><?=$work['name']?></td>
            <td><?php echo date( 'H:i', $work['timestart'] );?></td>
            <td><?php echo date( 'H:i', $work['timestop'] );?></td>
        </tr>
    <?php endforeach;?>
    </table>

    <h1>Sökträffar på användare <span>(<?=count( $data['users'] )?>)</span>st</h1>
    <table class="logg">
        <tr class="names">
            <td>#</td>
            <td>Användarnamn</td>
            <td></td>
        </tr>
        <?php foreach( $data['users'] as $user ): ?>
        <tr>
            <td>#<?=$user['id']?></td>
            <td><?=$user['name']?></td>
            <td><a href="/account/<?=$user['id']?>">Läs mer</a></td>
        </tr>
    <?php endforeach;?>
    </table>
</div>
