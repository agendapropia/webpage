class Pagination {
    /**
     * Create a paginated list
     * @param {HTMLElement} container - Container element
     * @param {number} itemsPerPage - Number of items to display per page. Defaults to 20.
     */
  
    constructor(container, itemsPerPage = 20) {
      this.container = container;
      this.itemsPerPage = itemsPerPage;
  
      this.list = this.container.querySelector('.js-pagination-items');
      this.listItems = Array.from(this.list.querySelectorAll('.js-pagination-item'));
  
      this.paginationNav = this.container.querySelector('.js-pagination-nav');
      if (!this.paginationNav) {
        return;
      }
      this.prevButton = this.paginationNav.querySelector('.js-pagination-prev');
      this.nextButton = this.paginationNav.querySelector('.js-pagination-next');
      this.paginationList = this.paginationNav.querySelector('.js-pagination-list');
  
      this.paginationListItemClass = 'js-pagination-list-item';
      this.hideClass = 'pagination-hide';
      this.selectedClass = 'pagination__list-item--selected';
      this.hashPrefix = '#page-';
  
      this.currentPage = 1;
      this.numberOfPages = null;
  
      this.init();
    }
  
    /**
     * The current page number based on the hash in the URL
     * @return {number | null} the page number
     */
    get hashPageNumber() {
      const { hash } = window.location;
  
      if (hash && hash.startsWith(this.hashPrefix)) {
        const hashParts = hash.split('-');
        const pageNum = hashParts[hashParts.length - 1];
        return Number(pageNum);
      }
  
      return null;
    }
  
    /**
     * If the current page is the first page
     * @return {boolean}
     */
    get isFirstPage() {
      return this.currentPage === 1;
    }
  
    /**
     * If the current page is the last page
     * @return {boolean}
     */
    get isLastPage() {
      return this.currentPage === this.numberOfPages;
    }
  
    /**
     * Set up pagination
     * @return {void}
     */
    init() {
      console.log('init');
      this.currentPage = this.hashPageNumber || 1;
  
      this.groupItems();
      this.insertPaginationNumbers();
      this.update();
  
      window.addEventListener(
        'hashchange',
        () => {
          if (!this.hashPageNumber) {
            return;
          }
          this.currentPage = this.hashPageNumber;
          this.update();
          this.container.scrollIntoView();
        },
        false,
      );
    }
  
    /**
     * Reset pagination
     * (used when filter state updates in pages like faculty directory)
     * @return {void}
     */
    reset(itemsToPaginate = this.listItems) {
      // Set this.currentPage back to 1
      this.currentPage = 1;
      // Remove hash from URL
      window.history.pushState(null, null, ' ');
  
      this.paginationNav.classList.remove(this.hideClass);
  
      // Remove hide class from all items
      this.listItems.forEach(item => {
        item.classList.remove(this.hideClass);
        item.removeAttribute('data-pagination');
      });
  
      this.groupItems(itemsToPaginate);
      this.insertPaginationNumbers();
      this.update(itemsToPaginate);
    }
  
    /**
     * Add data-group attributes to list items
     * depending on how many items should be on each page
     * @return {void}
     */
    groupItems(items = this.listItems) {
      let groupNum = 1;
  
      for (let index = 1; index <= items.length; index++) {
        const item = items[index - 1];
        // Set data attribute
        item.dataset['pagination'] = groupNum;
        // Increment group number
        if (index !== items.length && index === groupNum * this.itemsPerPage) {
          groupNum++;
        }
      }
  
      this.numberOfPages = groupNum;
    }
  
    /**
     * Create a pagination number list item
     * @return {HTMLElement} <li> item
     */
    createPaginationNumberItem(additionalClass = null) {
      const listItem = document.createElement('li');
  
      if (additionalClass) {
        listItem.classList.add(
          'pagination__list-item',
          this.paginationListItemClass,
          additionalClass,
        );
      } else {
        listItem.classList.add('pagination__list-item', this.paginationListItemClass);
      }
      return listItem;
    }
  
    /**
     * Insert list items to pagination number list
     * @return {void}
     */
    insertPaginationNumbers() {
      if (!this.paginationList) {
        return;
      }
  
      // Remove pagination numbers if present
      if (this.paginationList.hasChildNodes()) {
        this.paginationList.innerHTML = '';
      }
  
      // Add page numbers to pagination
      for (let index = 1; index <= this.numberOfPages; index++) {
        const listItem = this.createPaginationNumberItem();
        listItem.dataset['pagination'] = index;
        listItem.innerHTML = `
          <a href="${this.hashPrefix}${index}" class="pagination__link">${index}</a>
        `;
        this.paginationList.appendChild(listItem);
      }
  
      this.paginationNumbers = Array.from(
        this.paginationList.querySelectorAll(`.${this.paginationListItemClass}`),
      );
    }
  
    /**
     * Reset pagination number styles
     * @return {void}
     */
    resetPaginationNumbers() {
      if (!this.paginationList) {
        return;
      }
  
      const separators = Array.from(this.paginationList.querySelectorAll('.separator'));
  
      if (separators.length) {
        separators.forEach(s => s.remove());
      }
  
      this.paginationNumbers.forEach(item => item.classList.remove(this.hideClass));
    }
  
    /**
     * Insert an ellipsis before the given item
     * @param {HTMLElement} item reference node
     * @return {void}
     */
    insertEllipsisBefore(item) {
      if (!this.paginationList) {
        return;
      }
  
      const listItem = this.createPaginationNumberItem('separator');
      listItem.innerHTML = `
        <span class="pagination__indicator" styles='color: var(--clr-white); background: var(--clr-grey-100);' aria-label="Page …">  … </span>
      `;
      this.paginationList.insertBefore(listItem, item);
    }
  
    /**
     * Visually truncate page numbers
     * @return {void}
     */
    truncatePaginationNumbers() {
      this.resetPaginationNumbers();
  
      // If there are less than 5 pages, no need to truncate
      if (this.numberOfPages <= 5) {
        return;
      }
  
      const clusterSize = 3;
      const last = this.numberOfPages - 1;
      const median = Math.round(this.numberOfPages / 2);
      const numPagesBeforeEnd = this.numberOfPages - this.currentPage;
  
      // First page (1 2 3 ... 10)
      if (this.isFirstPage) {
        this.paginationNumbers.forEach((item, index) => {
          if (index >= clusterSize && index !== last) {
            item.classList.add(this.hideClass);
          }
          if (index === this.numberOfPages - 1) {
            this.insertEllipsisBefore(item);
          }
        });
  
        return;
      }
  
      // Last page (1 ... 8 9 10)
      if (this.isLastPage) {
        const reversedNumbers = Array.from(this.paginationNumbers).reverse();
        reversedNumbers.forEach((item, index) => {
          if (index >= clusterSize && index !== last) {
            item.classList.add(this.hideClass);
          }
          if (index === this.numberOfPages - 2) {
            this.insertEllipsisBefore(item);
          }
        });
  
        return;
      }
  
      // Otherwise, add ellipsis in between (1 ... 4 5 6 ... 10)
      this.paginationNumbers.forEach((item, index) => {
        const pagesToShow = [
          1, // first page
          this.numberOfPages, // last page
          this.currentPage, // current page
          this.currentPage - 1, // page before current page
          this.currentPage + 1, // page after current page
        ];
  
        if (!pagesToShow.includes(index + 1)) {
          item.classList.add(this.hideClass);
        }
  
        if (
          (index === 1 && this.currentPage > clusterSize) ||
          (index === last && (this.currentPage <= median || numPagesBeforeEnd >= clusterSize))
        ) {
          this.insertEllipsisBefore(item);
        }
      });
    }
  
    /**
     * Add the hide class to all items except items on the current page
     * @return {void}
     */
    visuallyHideItems(items = this.listItems) {
      if (!items.length) {
        return;
      }
  
      items.forEach(item => {
        item.classList.remove(this.hideClass);
        // Hide all items not on this page
        if (Number(item.dataset['pagination']) !== this.currentPage) {
          item.classList.add(this.hideClass);
        }
      });
    }
  
    /**
     * Based on current page, handle updating prev/next links,
     * adding/removing the selected class, and showing the correct items
     * @return {void}
     */
    update(items = undefined) {
      // Hide pagination if there's only one page
      if (this.numberOfPages === 1) {
        this.paginationNav.classList.add(this.hideClass);
        return;
      }
  
      // Default to first page if current page number is invalid
      if (this.currentPage > this.numberOfPages) {
        this.currentPage = 1;
        window.history.pushState(null, null, '#');
      }
  
      // Add ellipsis where necessary
      this.truncatePaginationNumbers();
  
      // Update prev/next button hrefs
      this.prevButton.href = this.isFirstPage ? '#' : `${this.hashPrefix}${this.currentPage - 1}`;
      this.nextButton.href = this.isLastPage ? '#' : `${this.hashPrefix}${this.currentPage + 1}`;
  
      // Disable prev/next button if on first or last page
      this.prevButton.toggleAttribute('disabled', this.currentPage === 1);
      this.nextButton.toggleAttribute('disabled', this.currentPage === this.numberOfPages);
  
      // Update list items being shown
      this.visuallyHideItems(items);
  
      // Add class to selected pagination number
      this.paginationNumbers.forEach(item => {
        item.classList.remove(this.selectedClass);
  
        if (Number(item.dataset['pagination']) === this.currentPage) {
          item.classList.add(this.selectedClass);
        }
      });
    }
  }
  
  
  const paginationContainers = document.querySelectorAll('.js-pagination');
  
  if (paginationContainers.length) {
    paginationContainers.forEach(container => new Pagination(container, 10));
  }