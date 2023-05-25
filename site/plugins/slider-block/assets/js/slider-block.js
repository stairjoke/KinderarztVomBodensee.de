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
  #slider; #pages; #imagesPaginated; #zoom; #imagesZoomed; #controlsPaginated; #controlsZoomed; #previousButton; #nextButton; #currentPage; #itemsPerPage; #currentImageZoomed;

    constructor(sliderNode) {
        this.#slider = sliderNode
        this.setPages()
        this.setImagesPaginated()
        this.setZoom()
        this.setImagesZoomed()
        this.setControlsPaginated()
        this.setControlsZoomed()
        this.setPreviousButton()
        this.setNextButton()
        this.setItemsPerPage()

        this.selfTest()

        this.getNextButton().addEventListener('click', this.nextButtonClicked.bind(this))
        this.getPreviousButton().addEventListener('click', this.previousButtonClicked.bind(this))
        this.#slider.querySelectorAll('.slider-block-elements, .slider-block-zoom').forEach((node) => {
          node.addEventListener('scroll', this.monitorScrolling.bind(this))
        });
    }

    selfTest(){
      this.getPages()
      this.getImagesPaginated()
      this.getZoom()
      this.getImagesZoomed()
      this.getControlsPaginated()
      this.getControlsZoomed()
      this.getPreviousButton()
      this.getNextButton()
      this.getCurrentPage()
      this.getItemsPerPage()
      this.setItemsPerPage()
      this.setCurrentPage()
      this.setCurrentImageZoomed()
    }

    getPages(){
      if(this.#pages === undefined) {
        throw new Error('Private variable "pages" undefined')
      }
      return this.#pages
    }
    setPages(slider = this.#slider){
      return this.#pages = slider.querySelectorAll('.slider-page')
    }

    getImagesPaginated(){
      if(this.#imagesPaginated === undefined) {
        throw new Error('Private variable "imagesPaginated" undefined')
      }
      return this.#imagesPaginated
    }
    setImagesPaginated(slider = this.#slider){
      return this.#imagesPaginated = slider.querySelectorAll('.slider-block-elements img')
    }

    getZoom(){
      if(this.#zoom === undefined) {
        throw new Error('Private variable "zoom" undefined')
      }
      return this.#zoom
    }
    setZoom(slider = this.#slider){
      return this.#zoom = slider.querySelector('.slider-block-zoom')
    }

    getImagesZoomed(){
      if(this.#imagesZoomed === undefined) {
        throw new Error('Private variable "imagesZoomed" undefined')
      }
      return this.#imagesZoomed
    }
    setImagesZoomed(slider = this.#slider){
      return this.#imagesZoomed = slider.querySelectorAll('.slider-block-zoom img')
    }

    getControlsPaginated(){
      if(this.#controlsPaginated === undefined) {
        throw new Error('Private variable "controlsPaginated" undefined')
      }
      return this.#controlsPaginated;
    }
    setControlsPaginated(slider = this.#slider){
      return this.#controlsPaginated = slider.querySelector('.slider-block-controls .paginated')
    }

    getControlsZoomed(){
      if(this.#controlsZoomed === undefined) {
        throw new Error('Private variable "controlsZoomed" undefined')
      }
      return this.#controlsZoomed
    }
    setControlsZoomed(slider = this.#slider){
      return this.#controlsZoomed = slider.querySelector('.slider-block-controls .singles')
    }

    getPreviousButton(){
      if(this.#previousButton === undefined) {
        throw new Error('Private variable "previousButton" undefined')
      }
      return this.#previousButton
    }
    setPreviousButton(slider = this.#slider){
      return this.#previousButton = slider.querySelector('.slider-block-stepper-button-previous')
    }

    getNextButton(){
      if(this.#nextButton === undefined) {
        throw new Error('Private variable "nextButton" undefined')
      }
      return this.#nextButton
    }
    setNextButton(slider = this.#slider){
      return this.#nextButton = slider.querySelector('.slider-block-stepper-button-next')
    }

    getItemsPerPage() {
      if(this.#itemsPerPage > 0) {
        return this.#itemsPerPage
      }else{
        throw new Error("Items per page of slider unknown. Check to see if the referenced '.slider-block'-node has a data-items-per-page-property with a number above zero!")
      }
    }
    setItemsPerPage(slider = this.#slider){
      return this.#itemsPerPage = slider.dataset.itemsPerPage
    }

    getCurrentPage(){
      if(this.#currentPage === undefined) {
        return this.setCurrentPage()
      }
      return this.#currentPage
    }
    setCurrentPage(page = 0) {
      this.#currentPage = page
      this.getControlsPaginated().querySelectorAll('li').forEach((control, index) => {
        (this.#currentPage != index) ? control.classList.remove('current') : control.classList.add('current')
      });
      return this.#currentPage
    }

    getCurrentImageZoomed(){
      if(this.#currentImageZoomed === undefined) {
        return this.setCurrentImageZoomed()
      }
      return this.#currentImageZoomed
    }
    setCurrentImageZoomed(image = 0){
      this.#currentImageZoomed = image
      this.getControlsZoomed().querySelectorAll('li').forEach((control, index) => {
        (this.#currentImageZoomed != index) ? control.classList.remove('current') : control.classList.add('current')
      });
      return this.#currentImageZoomed
    }

    // --- //

    isScrolledIntoView(parentNode, childNode) {
      // This method assumed a left to right or right to left scroll. It will not work for up-down scrollers!

      let parentRect = parentNode.getBoundingClientRect();
      let childRect = childNode.getBoundingClientRect();

      return (
        childRect.left >= parentRect.left &&
        childRect.right <= parentRect.right
      );
    }

    scrolled(){
      this.getPages().forEach((page, index) => {
        if(this.isScrolledIntoView(this.#slider, page)) {
          this.setCurrentPage(index)
        }
      });

      this.getImagesZoomed().forEach((image, index) => {
        if(this.isScrolledIntoView(this.#slider, image)) {
          this.setCurrentImageZoomed(index)
        }
      });
    }

    #scrollTimeoutID = false;
    monitorScrolling(){
      if(this.#scrollTimeoutID){
        window.clearTimeout(this.#scrollTimeoutID)
      }
      this.#scrollTimeoutID = window.setTimeout(this.scrolled.bind(this), 80)
    }

    scrollToPage(page = 0){
      let pages = this.getPages();
      pages[page].scrollIntoView({ behavior: 'smooth', block: 'nearest', inline: 'center' });
      this.setCurrentPage(page)
    }

    nextButtonClicked(event){
      let page = this.getCurrentPage() + 1;
      if(page >= this.getPages().length){
        page = 0
      }
      this.scrollToPage(page)
    }

    previousButtonClicked(event) {
      let page = this.getCurrentPage() - 1;
      if(page < 0){
        page = this.getPages().length - 1
      }
      this.scrollToPage(page)
    }
}

window.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll('.slider-block').forEach((slider) => {
    if(slider.querySelector('.slider-block-controls')) {

      let sliderInstance = new sliderBlock(slider)
      //console.log(sliderInstance.getItemsPerPage())

    }
  })
})
