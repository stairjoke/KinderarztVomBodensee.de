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
    Kind of object
  </summary>
  <ul>
    <li>column title: row data</li> !! exception: last row dispalys with no column title !!
  </ul>
</details>
*/

class ProductDetailsBlock {
  #blockRead;
  #blockWrite;
  #blockDataId;
  #data = {
    'columnTitles': [],
    'productRows': []
  };

  constructor(blockNode) {
    this.#blockRead = blockNode;
    this.initData();

    //setBlockWrite relies on data, it must come after initData()!
    this.setBlockWrite()

    //Must be last called
    this.renderData()
  }

  /*
    - read data from table
    - write data to div as detail-nodes
  */

  getBlockRead(){
    return this.#blockRead;
  }

  getBlockWrite(){
    return this.#blockWrite;
  }

  setBlockWrite(){
    this.#blockWrite = document.querySelector('div[data-id="' + this.getDataId() + '"]');
    this.#blockWrite.innerHTML = "";
    console.log(this.getBlockWrite())
  }

  initData() {
    this.setDataId(this.getBlockRead().dataset.id)

    // Read Column Titles
    this.getBlockRead().querySelectorAll('th').forEach((th) => {
      this.#data.columnTitles.push(th.innerHTML);
    })

    // Read Product Rows
    this.getBlockRead().querySelectorAll('tbody tr').forEach((tr) => {
      let row = [];

      tr.querySelectorAll('td').forEach((td) => {
        row.push(td.innerHTML);
      })

      this.#data.productRows.push(row);
    })

    console.log(this.#data);
  }

  getDataId() {
    return this.#blockDataId;
  }

  setDataId(id) {
    this.#blockDataId = id;
    console.log(this.getDataId())
  }

  createElementAndAppendTo(kind, innerHTML = "", parentNode) {
    const element = document.createElement(kind);
    element.innerHTML = innerHTML;
    parentNode.appendChild(element);
    return element;
  }

  renderData(){
    let first = true;
    this.#data.productRows.forEach((row) => {
      const detail = document.createElement("details");
      if(first) {
        detail.setAttribute("open", "")
        first = false
      }
      const list = document.createElement("ul");

      this.createElementAndAppendTo("summary", row[0], detail);
      for(let i = 1; i < 3; i++){
        if(row[i] != "" && row[i] != "-" && row[i] != "–" && row[i] != "—" && row[i] != " "){
          this.createElementAndAppendTo("li", this.#data.columnTitles[i] + ": " + row[i], list);
        }
      }
      this.createElementAndAppendTo("li", row[3], list);

      detail.appendChild(list);
      this.getBlockWrite().appendChild(detail);

    })
  }
}

window.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll('.productDetails').forEach((node) => {
    new ProductDetailsBlock(node);
  })
})
