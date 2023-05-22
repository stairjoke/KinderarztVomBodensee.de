// Slider Block Logic

/*

  Stories:
  # Previous/Next buttons
  On any page but the last: User clicks on next button, page scrolls to next page.
  On last page: Next button hidden.

  On any page but the first: User clicks on previous button, page scrolls to the previous page.
  On the first page: Previous button hidden.

  # Nav-Buttons in the bottom
  User clicks on a nav button, the container scrolls to that page.

  ---

  - Number of pages: Done in PHP, available in HTML markup: data-number-of-pages.
  - CSS is set up to automatically snap scroll images in .slider-block-elements
  - CSS is set up to enforce smooth scrolling

  ---

  # Previous/Next buttons

  # Nav-Buttons in the bottom
  IF page number is greater than current: scroll to last image on page
  IF page number is smaller than current: scroll to first image on page
  IF page number is current: scroll to first, then lasst item on page

*/

class sliderBlock {
  #slider; #pages; #previous; #next; #elements; #currentPage; #itemsPerPage;

    constructor(sliderNode) {
        this.#slider = sliderNode;
        this.#pages = sliderNode.querySelectorAll('.slider-block-controls li');
        this.#previous = sliderNode.querySelector('.slider-block-stepper-button-previous');
        this.#next = sliderNode.querySelector('.slider-block-stepper-button-next');
        this.#elements = sliderNode.querySelectorAll('.slider-block-elements > *');
        this.#itemsPerPage = sliderNode.dataset.itemsPerPage;
        this.#currentPage = 0;

        // Start the slider at the beginning
        this.setCurrentPage(0);
    }

    /*

     - attach click events to previous/next
     - attach click events to nav > li
     - listen for scroll events on .slider-block-elements

    */

    /*#isDOMElement(node) {
      // If the browser knows HTMLElement, test if the node is an HTMLElement
      // If the browser does not know it, test if
      // - node equates to and is of type object
      // - node is not null
      // - node is of Type 1 (HTMLElement)
      // - node name is a string
      return(typeof HTMLElement === "object" ? node instanceof HTMLElement : node && typeof node === "object" && node !== null && node.nodeType === 1 && typeof node.nodeName === "string")
    }*/

    getItemsPerPage() {
      if(this.#itemsPerPage > 0) {
        return this.#itemsPerPage;
      }else{
        throw new Error("Items per page of slider unknown. Check to see if the referenced '.slider-block'-node has a data-items-per-page-property with a number above zero!");
      }
    }

    setCurrentPage(item) {
      var fromPage = this.#currentPage; // Store current page for later
      this.#currentPage = Math.floor(item/this.getItemsPerPage()); // Determine new page
      this.updateScrollPosition(fromPage);

      this.#pages.forEach((page) => { page.classList.remove('current') }) // remove the .current class form all li-elements in the nav
      this.#pages[this.#currentPage].classList.add('current'); // Add .current class to the current nav element
    }

    updateScrollPosition(fromPage) {
      // Scrolling in layout direction
      if(fromPage < this.#currentPage) {
        var scrollTarget = this.#itemsPerPage * this.#currentPage;
      }

      // Scrolling against layout direction
      if(fromPage > this.#currentPage) {
        var scrollTarget = (this.#itemsPerPage * this.#currentPage) - (this.#itemsPerPage - 1);
      }

      // Scroll target element into view
      this.#elements[scrollTarget].scrollIntoView();
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll('.slider-block').forEach((slider) => {
    if(slider.querySelector('.slider-block-controls')) {

      var sliderInstance = new sliderBlock(slider);
      console.log(sliderInstance.getItemsPerPage());

    }
  });
});
