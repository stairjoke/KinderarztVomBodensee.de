<?php
  // Featured Videos Block — Der Kinderarzt vom Bodensee
?>
<section class="featured-videos-block">
<?php
  $featuredVideos = $block->featured()->toPages();
  foreach($featuredVideos as $video) : ?>
    <div class="video">
      <?= ($video->hasImages()) ? $video->image() : '<img src="/assets/images/Thumbnail-none.jpg" />' ?>
      <h2><a href="<?= $video->url() ?>" target="_blank">
        <svg class="icon inline" aria-label="YouTube Logo">
          <use href="/assets/images/iconSprite.svg#youtube"></use>
        </svg>&nbsp;<span><?= $video->title() ?></span>
      </a></h2>
      <?= $video->beschreibung()->kt() ?>
    </div>
  <?php endforeach; // $featuredVideos ?>
  </section>