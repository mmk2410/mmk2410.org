<?php
/**
 * @var ScribblePage $scribble
 * @var bool $singlePage
 */

$headlineLevel = $singlePage ? 1 : 2;
$title = $scribble->date()->toDate('j. F Y @ H:i');
?>

<article class="scribble">
  <h<?= $headlineLevel ?>>
    <?php if (!$singlePage): ?>
      <a href="<?= $scribble->url() ?>"><?= $title ?></a>
    <?php else: ?>
      <?= $title ?>
    <?php endif ?>
  </h<?= $headlineLevel ?>>

  <?= $scribble->text()->kirbytext() ?>
</article>
