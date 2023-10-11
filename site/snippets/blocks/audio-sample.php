<?php
  // Audio Sample Block — Der Kinderarzt vom Bodensee
?>

<figure>
  <figcaption><?= $block->label()->kirbytextinline() ?></figcaption>
  <audio controls controlslist="nofullscreen nodownload" preload="metadata">
    <?php
      $samples = $block->samples()->tofiles();
      foreach($samples as $sample):
    ?>
    <source src="<?= $sample->url() ?>" />
    <?php
      endforeach;
    ?>
  </audio>
</figure>
