<?php
/**
 * @var ScribblePage $page
 */
?>

<?php snippet('layout', slots: true) ?>
<?php slot() ?>
  <?php snippet('scribble', ['scribble' => $page, 'singlePage' => true]) ?>

  <a href="<?= page('scribbles')->url() ?>">More mindless drivel</a>
<?php endslot() ?>
