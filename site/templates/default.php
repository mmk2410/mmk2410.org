<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<h1><?= $page->title() ?></h1>

<?= $page->text()->kirbytext() ?>
<?php endslot() ?>
