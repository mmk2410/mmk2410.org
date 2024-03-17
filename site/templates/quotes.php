<?php snippet('layout', slots: true) ?>
<?php slot() ?>
<h1><?= $page->title() ?></h1>

<?= $page->text()->kirbytext() ?>

<?php foreach($quotes as $quote): ?>
  <article>
    <h2><a href="<?= $quote->url() ?>"><?= $quote->title() ?></a></h2>
    <p id="date"><?= $quote->date()->toDate('Y-m-d') ?></p>

    <p>
      <?= $quote->text()->kirbytext() ?>
    </p>
  </article>
<?php endforeach ?>

<?php if ($quotes->pagination()->hasPages()): ?>
  <nav class="pagination">
    <?php if ($quotes->pagination()->hasNextPage()): ?>
      <a class="page-item next" href="<?= $quotes->pagination()->nextPageURL() ?>">
        ‹ ältere Einträge
      </a>
    <?php endif ?>

    <?php if ($quotes->pagination()->hasPrevPage()): ?>
      <a class="page-item prev" href="<?= $quotes->pagination()->prevPageURL() ?>">
        neuere Einträge ›
      </a>
    <?php endif ?>
  </nav>
<?php endif ?>

<?php endslot() ?>
