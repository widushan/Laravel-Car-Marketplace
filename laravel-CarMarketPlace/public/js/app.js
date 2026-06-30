document.addEventListener("DOMContentLoaded", function () {
  const initSlider = () => {
    const slides = document.querySelectorAll(".hero-slide");
    let currentIndex = 0; // Track the current slide
    const totalSlides = slides.length;

    function moveToSlide(n) {
      slides.forEach((slide, index) => {
        slide.style.transform = `translateX(${-100 * n}%)`;
        if (n === index) {
          slide.classList.add("active");
        } else {
          slide.classList.remove("active");
        }
      });
      currentIndex = n;
    }

    // Function to go to the next slide
    function nextSlide() {
      if (currentIndex === totalSlides - 1) {
        moveToSlide(0); // Go to the first slide if we're at the last
      } else {
        moveToSlide(currentIndex + 1);
      }
    }

    // Function to go to the previous slide
    function prevSlide() {
      if (currentIndex === 0) {
        moveToSlide(totalSlides - 1); // Go to the last slide if we're at the first
      } else {
        moveToSlide(currentIndex - 1);
      }
    }

    // Example usage with buttons
    // Assuming you have buttons with classes `.next` and `.prev` for navigation
    const carouselNextButton = document.querySelector(".hero-slide-next");
    if (carouselNextButton) {
      carouselNextButton.addEventListener("click", nextSlide);
    }
    const carouselPrevButton = document.querySelector(".hero-slide-prev");
    if (carouselPrevButton) {
      carouselPrevButton.addEventListener("click", prevSlide);
    }

    // Initialize the slider
    moveToSlide(0);
  };

  const initImagePicker = () => {
    const fileInput = document.querySelector("#carFormImageUpload");
    const imagePreview = document.querySelector("#imagePreviews");
    if (!fileInput) {
      return;
    }
    
    let dt = new DataTransfer();

    fileInput.onchange = (ev) => {
      const files = ev.target.files;
      for (let file of files) {
        dt.items.add(file);
      }
      
      // Update file input files
      fileInput.files = dt.files;
      
      // Render all previews
      renderPreviews();
    };

    const renderPreviews = () => {
      imagePreview.innerHTML = "";
      Array.from(fileInput.files).forEach((file, index) => {
        readFile(file).then((url) => {
          const img = createImage(url, index);
          imagePreview.append(img);
        });
      });
    };

    function readFile(file) {
      return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onload = (ev) => {
          resolve(ev.target.result);
        };
        reader.onerror = (ev) => {
          reject(ev);
        };
        reader.readAsDataURL(file);
      });
    }

    function createImage(url, index) {
      const a = document.createElement("div");
      a.classList.add("car-form-image-preview");
      a.style.position = "relative";
      a.innerHTML = `
        <img src="${url}" />
        <button type="button" class="btn-delete-image" data-index="${index}" style="position: absolute; top: -5px; right: -5px; background: #ef4444; color: white; border: none; border-radius: 50%; width: 22px; height: 22px; cursor: pointer; font-size: 14px; font-weight: bold; display: flex; align-items: center; justify-content: center; z-index: 10; box-shadow: 0 2px 4px rgba(0,0,0,0.2); transition: background 0.2s;">&times;</button>
      `;
      
      a.querySelector(".btn-delete-image").onclick = (e) => {
        e.preventDefault();
        const deleteIndex = parseInt(e.target.dataset.index);
        
        // Rebuild DataTransfer excluding the deleted item
        const newDt = new DataTransfer();
        const currentFiles = fileInput.files;
        for (let i = 0; i < currentFiles.length; i++) {
          if (i !== deleteIndex) {
            newDt.items.add(currentFiles[i]);
          }
        }
        dt = newDt;
        fileInput.files = dt.files;
        renderPreviews();
      };
      
      return a;
    }
  };

  const initMobileNavbar = () => {
    const btnToggle = document.querySelector(".btn-navbar-toggle");

    btnToggle.onclick = () => {
      document.body.classList.toggle("navbar-opened");
    };
  };

  const imageCarousel = () => {
    const carousel = document.querySelector('.car-images-carousel');
    if (!carousel) {
      return;
    }
    const thumbnails = document.querySelectorAll('.car-image-thumbnails img');
    const activeImage = document.getElementById('activeImage');
    const prevButton = document.getElementById('prevButton');
    const nextButton = document.getElementById('nextButton');


    let currentIndex = 0;

    // Initialize active thumbnail class
    thumbnails.forEach((thumbnail, index) => {
      if (thumbnail.src === activeImage.src) {
        thumbnail.classList.add('active-thumbnail');
        currentIndex = index;
      }
    });

    // Function to update the active image and thumbnail
    const updateActiveImage = (index) => {
      activeImage.src = thumbnails[index].src;
      thumbnails.forEach(thumbnail => thumbnail.classList.remove('active-thumbnail'));
      thumbnails[index].classList.add('active-thumbnail');
    };

    // Add click event listeners to thumbnails
    thumbnails.forEach((thumbnail, index) => {
      thumbnail.addEventListener('click', () => {
        currentIndex = index;
        updateActiveImage(currentIndex);
      });
    });

    // Add click event listener to the previous button
    prevButton.addEventListener('click', () => {
      currentIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
      updateActiveImage(currentIndex);
    });

    // Add click event listener to the next button
    nextButton.addEventListener('click', () => {
      currentIndex = (currentIndex + 1) % thumbnails.length;
      updateActiveImage(currentIndex);
    });
  }

  const initMobileFilters = () => {
    const filterButton = document.querySelector('.show-filters-button');
    const sidebar = document.querySelector('.search-cars-sidebar');
    const closeButton = document.querySelector('.close-filters-button');

    if (!filterButton) return;

    console.log(filterButton.classList)
    filterButton.addEventListener('click', () => {
      if (sidebar.classList.contains('opened')) {
        sidebar.classList.remove('opened')
      } else {
        sidebar.classList.add('opened')
      }
    });

    if (closeButton) {
      closeButton.addEventListener('click', () => {
        sidebar.classList.remove('opened')
      })
    }
  }

  const initCascadingDropdown = (parentSelector, childSelector) => {
    const parentDropdown = document.querySelector(parentSelector);
    const childDropdown = document.querySelector(childSelector);

    if (!parentDropdown || !childDropdown) return;

    hideModelOptions(parentDropdown.value)

    parentDropdown.addEventListener('change', (ev) => {
      hideModelOptions(ev.target.value)
      childDropdown.value = ''
    });

    function hideModelOptions(parentValue) {
      const models = childDropdown.querySelectorAll('option');
      models.forEach(model => {
        if (model.dataset.parent === parentValue || model.value === '') {
          model.style.display = 'block';
        } else {
          model.style.display = 'none';
        }
      });
    }
  }

  const initSortingDropdown = () => {
    const sortingDropdown = document.querySelector('.sort-dropdown');
    if (!sortingDropdown) return;

    // Init sorting dropdown with the current value
    const url = new URL(window.location.href);
    const sortValue = url.searchParams.get('sort');
    if (sortValue) {
      sortingDropdown.value = sortValue;
    }

    sortingDropdown.addEventListener('change', (ev) => {
      const url = new URL(window.location.href);
      url.searchParams.set('sort', ev.target.value);
      window.location.href = url.toString();
    });
  }

  initSlider();
  initImagePicker();
  initMobileNavbar();
  imageCarousel();
  initMobileFilters();
  initCascadingDropdown('#makerSelect', '#modelSelect');
  initCascadingDropdown('#stateSelect', '#citySelect');
  initSortingDropdown();

  const initResetButton = () => {
    const resetBtn = document.querySelector('.btn-find-a-car-reset');
    if (!resetBtn) return;

    resetBtn.addEventListener('click', () => {
      // Find the parent form
      const form = resetBtn.closest('form');
      if (!form) return;

      // Reset all text/number inputs
      form.querySelectorAll('input').forEach(input => {
        input.value = '';
      });

      // Reset all selects to their first (empty) option
      form.querySelectorAll('select').forEach(select => {
        select.value = '';
        // Trigger change so cascading dropdowns react (hide children)
        select.dispatchEvent(new Event('change'));
      });

      // If we're on the search results page, navigate to clean URL to clear server-side filters
      const url = new URL(window.location.href);
      if (url.pathname.includes('/car/search') || url.search.length > 0) {
        window.location.href = url.pathname;
      }
    });
  };

  initResetButton();

  const initWatchlist = () => {
    const watchListButtons = document.querySelectorAll('.btn-add-to-watchlist');
    watchListButtons.forEach(btn => {
      btn.addEventListener('click', (ev) => {
        ev.preventDefault();
        const carId = btn.dataset.id;
        fetch(`/car/${carId}/watchlist`, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          }
        }).then(res => {
          if (res.status === 401) {
            window.location.href = '/login';
            return;
          }
          if (res.ok) {
            // Toggle the heart icons
            const svgs = btn.querySelectorAll('svg');
            svgs.forEach(svg => svg.classList.toggle('hidden'));
          }
        })
      });
    });
  }

  initWatchlist();

  ScrollReveal().reveal(".hero-slide.active .hero-slider-title", {
    delay: 200,
    reset: true,
  });
  ScrollReveal().reveal(".hero-slide.active .hero-slider-content", {
    delay: 200,
    origin: "bottom",
    distance: "50%",
  });
});
