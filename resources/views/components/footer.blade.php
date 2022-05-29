<!-- CTA -->
<div class="flex flex-col bg-cta-beige relative overflow-hidden">
  <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:items-center lg:justify-between position:relative z-10">
    <h2 class="about-us-title text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
      <span class="block">How can we help you?</span>
      <span class="block text-orange">Book your free estimate.</span>
    </h2>
    <div class="sm:justify-center mt-8 flex md:mt-8 lg:mt-12 lg:flex-shrink-0">
      <div class="inline-flex rounded-md shadow">
        <a href="tel:+019053517947" class="body-text inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange">
          <strong>Call us now (905-351-7947)</strong>
        </a>
      </div>
      <div class="ml-3 inline-flex rounded-md shadow">
        <a href="mailto:contact@kimpaint.com" class="body-text inline-flex items-center justify-center px-5 py-3 border border-transparent text-base font-medium rounded-md text-orange bg-whitebutton">
          <strong>Email us</strong>
        </a>
      </div>
    </div>
  </div>
  <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#f2ece4" fill-opacity="1" d="M0,224L80,218.7C160,213,320,203,480,218.7C640,235,800,277,960,250.7C1120,224,1280,128,1360,80L1440,32L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
  </svg>
</div>

<!-- contact us -->

<!-- footer -->
<footer class="hero-title text-center lg:text-left bg-footer-bg text-gray-600">
  <div class="max-w-7xl mx-auto flex justify-center items-center lg:justify-between p-6 border-b border-gray-300">
    <div class="mr-12 hidden lg:block">
      <span>Get connected with us on social networks:</span>
    </div>
    <div class="flex justify-center">
      <a href="https://www.kijiji.ca/v-painters-painting/st-catharines/kim-and-co-painters/1597348153" class="mr-6 text-gray-600">
        <i class="fab fa-kaggle"></i>
      </a>
      <a href="https://instagram.com/jones_painter" class="mr-6 text-gray-600">
        <i class="fab fa-instagram"></i>
      </a>
    </div>
  </div>
  <div class="max-w-7xl mx-auto py-10 p-6 text-center md:text-left">
    <div class="grid grid-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      <div class="">

        <a href="/"><h1 class="logo-text mb-3"><strong>KIMPAINT</strong></h1></a>
        
        <p>
          Providing a fast, affordable and friendly painting service to the Niagara region. 
        </p>
      </div>
      <div class="">
        <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
          Sitemap
        </h6>
        @foreach ($menuLinks as $link)
          <p class="mb-4">
            <a href="{{ url('/'.$link->slug) }}" class="text-gray-600">{{ $link->label }}</a>
          </p>
        @endforeach
      </div>
      <div class="">
        <h6 class="uppercase font-semibold mb-4 flex justify-center md:justify-start">
          Contact
        </h6>
        <p class="flex items-center justify-center md:justify-start mb-4">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="home"
            class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
            <path fill="currentColor"
              d="M280.37 148.26L96 300.11V464a16 16 0 0 0 16 16l112.06-.29a16 16 0 0 0 15.92-16V368a16 16 0 0 1 16-16h64a16 16 0 0 1 16 16v95.64a16 16 0 0 0 16 16.05L464 480a16 16 0 0 0 16-16V300L295.67 148.26a12.19 12.19 0 0 0-15.3 0zM571.6 251.47L488 182.56V44.05a12 12 0 0 0-12-12h-56a12 12 0 0 0-12 12v72.61L318.47 43a48 48 0 0 0-61 0L4.34 251.47a12 12 0 0 0-1.6 16.9l25.5 31A12 12 0 0 0 45.15 301l235.22-193.74a12.19 12.19 0 0 1 15.3 0L530.9 301a12 12 0 0 0 16.9-1.6l25.5-31a12 12 0 0 0-1.7-16.93z">
            </path>
          </svg>
          Niagara Falls, ON Canada
        </p>
        <p class="flex items-center justify-center md:justify-start mb-4">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="envelope"
            class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512">
            <path fill="currentColor"
              d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
            </path>
          </svg>
          <a href="mailto:contact@kimpaint.com">contact@kimpaint.com</a>
        </p>
        <p class="flex items-center justify-center md:justify-start mb-4">
          <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone"
            class="w-4 mr-4" role="img" xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512">
            <path fill="currentColor"
              d="M493.4 24.6l-104-24c-11.3-2.6-22.9 3.3-27.5 13.9l-48 112c-4.2 9.8-1.4 21.3 6.9 28l60.6 49.6c-36 76.7-98.9 140.5-177.2 177.2l-49.6-60.6c-6.8-8.3-18.2-11.1-28-6.9l-112 48C3.9 366.5-2 378.1.6 389.4l24 104C27.1 504.2 36.7 512 48 512c256.1 0 464-207.5 464-464 0-11.2-7.7-20.9-18.6-23.4z">
            </path>
          </svg>
          <a href="tel:+019053517947">+1 905 351 7947</a>
        </p>
      </div>
    </div>
  </div>
  <div class="text-center text-white p-6 bg-footer-bg-2">
    <span><p>© 2022 Kim Painting. All rights reserved.</p>
              <p>Built by <a href="https://dallan.ca/"><strong>Dallan</strong></a><p></span>
  </div>
</footer>

<script src="./js/slider.js"></script>