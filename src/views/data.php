<style>
    .mmntm-data {
        position: fixed;
        bottom: 0;
        right: 0;
        background-color: rgba(255,255,255,0.5);
        display: inline-block;
    }
</style>
<div class="mmntm-data">
    <ul>
    <?php foreach($keys as $key) { ?>
        <li><?= $key ?></li>
    <?php } ?>
    </ul>
</div>
