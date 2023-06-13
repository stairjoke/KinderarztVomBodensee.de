// Product Details Block rendering engine

/*
  # Read data from

table.productDetails[data-id="<?= $block->id() ?>"]:
  thead:
    - th

  tbody:
    - td
    - td
    - td
    - td

# And render it into this node

div[data-id="<?= $block->id() ?>"]

# This way

<details>
  <summary>
    Column Title
  </summary>
  <ul>
    <li>Row data</li>
  </ul>
</details>
*/
