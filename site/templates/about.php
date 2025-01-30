<?php
/**
 * @var Kirby\Cms\Page $page
 */
?>

<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<h1><?= $page->title() ?></h1>

<div style="text-align: center; margin: 20px 0;">
  <img src="<?= $page->image('profile.png')->url() ?>" style="width: 300px" />
  <div style="font-size: 40px">
    <strong><?= $page->intro_title() ?></strong>
  </div>
  <div style="font-size: 25px">
    <?= $page->intro_text() ?>
  </div>
</div>

<?= $page->text()->kirbytext() ?>
<?php endslot() ?>
