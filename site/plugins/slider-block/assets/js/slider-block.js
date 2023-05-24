// Slider Block Logic

/*

  # DOM Nodes
  div.slider-block:
    div.slider-block-elements.two/three
      - div.slider-page
        - images
    div.slider-block-zoom
      - images
    div.slider-block-controls
      nav
        ol.paginated
        ol.singles
    img.slider-block-stepper-button-previous
    img.slider-block-stepper-button-next

  # Stories:
  ## Previous/Next buttons
  On any page but the last: User clicks on next button, page scrolls to next page.
  On last page: Next button hidden.

  On any page but the first: User clicks on previous button, page scrolls to the previous page.
  On the first page: Previous button hidden.

  ## Previous/Next buttons

  # Nav-Buttons in the bottom
  User clicks on a nav button, the container scrolls to that page.

  #Notes
  - Number of pages: Done in PHP, available in HTML markup: data-number-of-pages.
  - CSS is set up to automatically snap scroll pages/images in .slider-block-elements and .slider-block-zoom
  - CSS is set up to enforce smooth scrolling

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

    getItemsPerPage() {
      if(this.#itemsPerPage > 0) {
        return this.#itemsPerPage;
      }else{
        throw new Error("Items per page of slider unknown. Check to see if the referenced '.slider-block'-node has a data-items-per-page-property with a number above zero!");
      }
    }

    setCurrentPage(item) {
      let fromPage = this.#currentPage; // Store current page for later
      this.#currentPage = Math.floor(item/this.getItemsPerPage()); // Determine new page
      this.updateScrollPosition(fromPage);

      this.#pages.forEach((page) => { page.classList.remove('current') }) // remove the .current class form all li-elements in the nav
      this.#pages[this.#currentPage].classList.add('current'); // Add .current class to the current nav element
    }

    updateScrollPosition(fromPage) {
      let scrollTarget = 0;

      // Scrolling in layout direction
      if(fromPage < this.#currentPage) {
        scrollTarget = this.#itemsPerPage * this.#currentPage;
      }

      // Scrolling against layout direction
      if(fromPage > this.#currentPage) {
        scrollTarget = (this.#itemsPerPage * this.#currentPage) - (this.#itemsPerPage - 1);
      }

      // Scroll target element into view
      this.#elements[scrollTarget].scrollIntoView();
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll('.slider-block').forEach((slider) => {
    if(slider.querySelector('.slider-block-controls')) {

      let sliderInstance = new sliderBlock(slider);
      console.log(sliderInstance.getItemsPerPage());

    }
  });
});
