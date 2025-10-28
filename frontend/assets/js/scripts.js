window.addEventListener('DOMContentLoaded', event => {

    // Navbar shrink function
    var navbarShrink = function () {
        const navbarCollapsible = document.body.querySelector('#mainNav');
        if (!navbarCollapsible) return;
        if (window.scrollY === 0) {
            navbarCollapsible.classList.remove('navbar-shrink')
        } else {
            navbarCollapsible.classList.add('navbar-shrink')
        }
    };

    // Shrink the navbar 
    navbarShrink();
    document.addEventListener('scroll', navbarShrink);

    // ScrollSpy
    const mainNav = document.body.querySelector('#mainNav');
    if (mainNav) {
        new bootstrap.ScrollSpy(document.body, {
            target: '#mainNav',
            rootMargin: '0px 0px -40%',
        });
    }

    // Collapse mobile nav
    const navbarToggler = document.body.querySelector('.navbar-toggler');
    const responsiveNavItems = [].slice.call(
        document.querySelectorAll('#navbarResponsive .nav-link')
    );
    responsiveNavItems.map(function (item) {
        item.addEventListener('click', () => {
            if (window.getComputedStyle(navbarToggler).display !== 'none') {
                navbarToggler.click();
            }
        });
    });

    if (document.querySelector('#portfolio')) {
        window.simpleLightboxInstance = new SimpleLightbox({
            elements: '#portfolio a.portfolio-box'
        });
    }
});

$(document).on("spapp:changed", function () {
    if (document.querySelector('#portfolio')) {
        if (window.simpleLightboxInstance) {
            window.simpleLightboxInstance.destroy();
        }
        window.simpleLightboxInstance = new SimpleLightbox('#portfolio a.portfolio-box');
    }
});
$(document).on("spapp:changed", function () {

    if (window.simpleLightboxInstance) {
        window.simpleLightboxInstance.destroy();
    }

    if (document.querySelector('#portfolio')) {
        window.simpleLightboxInstance = new SimpleLightbox({
            elements: '#portfolio a.portfolio-box',
            captions: true,
            captionSelector: 'self',
            captionType: 'attr',
            captionsData: 'title',
            captionDelay: 250,
        });
    }
});
  document.addEventListener('DOMContentLoaded', function () {

    document.addEventListener('click', function (e) {
      const target = e.target.closest('.portfolio-box');
      if (!target) return;

      const activity = target.getAttribute('data-activity');
      const accommodation = target.getAttribute('data-accommodation');
      const date = target.getAttribute('data-date');
      const location = target.getAttribute('data-location');
      const price = target.getAttribute('data-price');
      const description = target.getAttribute('data-description') || 
        "Includes breakfast, mountain view, free Wi-Fi, and parking.";
      const bookingLink = target.getAttribute('data-booking') || "#";

 
      document.getElementById('modalActivity').textContent = activity;
      document.getElementById('modalAccommodation').textContent = accommodation;
      document.getElementById('modalDate').textContent = date;
      document.getElementById('modalLocation').textContent = location;
      document.getElementById('modalPrice').textContent = price || "Price available on request";
      document.getElementById('modalDescription').textContent = description;


      const bookButton = document.getElementById('bookNowButton');
      bookButton.setAttribute('href', bookingLink);
    });

    const bookNowButton = document.getElementById("bookNowButton");
    const infoModal = document.getElementById("infoModal");

    bookNowButton.addEventListener("click", function (event) {
      event.preventDefault();


      const modalInstance = bootstrap.Modal.getInstance(infoModal);
      if (modalInstance) {
        modalInstance.hide();
      }


      setTimeout(function () {
        const bookingSection = document.getElementById("booking");
        if (bookingSection) {
          bookingSection.scrollIntoView({ behavior: "smooth" });
        } else {
          const link = bookNowButton.getAttribute("href");
          if (link && link !== "#") {
            window.location.href = link;
          }
        }
      }, 500);
    });

  });

