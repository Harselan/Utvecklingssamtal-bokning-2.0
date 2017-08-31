<div class="form-wrapper center">
    <h1>Ändra arbetslogg</h1>
    <form action="<?= $data['id'] ?>" method="post">
        <select name="workplace">
            <option disabled="disabled">Arbetsplats</option>
            <?php foreach( $workplace as $work ): ?>
                <option value="<?= $work['id'] ?>"><?= $work['name'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="date">Starttid:</label>
        <input type="text" name="from" placeholder="HH:ii" value="<?php echo date('H:i', $data['timestart']) ?>" required>
        <input type="hidden" name="date" value="<?= date( 'Y/m/d', $data['timestart'] ); ?>">
        <label for="date">Stoptid:</label>
        <input type="text" name="to" placeholder="HH:ii" value="<?php echo date('H:i', $data['timestop']) ?>" required>

        <input type="submit" value="Ändra">
    </form>
</div>
