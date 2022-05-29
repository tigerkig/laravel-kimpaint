<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<div class="lg:hero-full-height relative bg-white overflow-hidden">
  <div class="headerFixedBg hidden max-w-full"></div>
  <div class="max-w-7xl mx-auto">
    <div class="relative z-20 pb-8 bg-white sm:pb-16 md:pb-20 lg:max-w-2xl lg:w-full lg:pb-28 xl:pb-32">
      <svg class="lg:hero-full-height hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
        <polygon points="50,0 100,0 50,100 0,100" />
      </svg>

      <div class="header" x-data="{ open: false, onPageLoad:false }">
        <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
          <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
            <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
              <div class="flex items-center justify-between w-full md:w-auto">
                <a href="/">
                  <span class="sr-only">Workflow</span>
                  <h1 class="logo-text"><strong>KIMPAINT</strong></h1>
                </a>
                <div class="-mr-2 flex items-center md:hidden">
                  <button id="openNavMenu" @click.prevent="open = !open, onPageLoad = true" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 navButton hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
            <!-- desktp nav menu -->
            <div class="hidden relative md:block md:ml-10 md:pr-4 md:space-x-8">
              @foreach ($menuLinks as $link)

                @php
                  $hasSubLinks = false;
                @endphp
                @foreach ($subMenuLinks as $subLink)
                    @if ($subLink->menuid == $link->id)
                      @php $hasSubLinks = true; @endphp
                    @endif
                @endforeach

                <span class="pb-3" x-data="{ open{{ $link->id }}: false, PageLoad{{ $link->id }}: true }" @mouseleave="open{{ $link->id }} = false">
                  @if ($hasSubLinks)
                    <button class="navMenu-link-desktop" @mouseover="PageLoad{{ $link->id }} = false, open{{ $link->id }} = true" class="font-medium navMenu-link-desktop">{{ $link->label }}
                      <i :class="{ 'hide': open{{ $link->id }} === true }" class="ml-2 fas fa-angle-down text-gray-400 hover:text-gray-500"></i>
                      <i :class="{ 'hide': open{{ $link->id }} === false }" class="ml-2 fas fa-angle-up text-gray-400 hover:text-gray-500"></i>
                    </button>
                  @else
                    <a href="{{ url('/'.$link->slug) }}" class="font-medium navMenu-link-desktop">{{ $link->label }}</a>
                  @endif
                
                @if ($hasSubLinks)
                  <div x-show="open{{ $link->id }}" :class="{ 'hide': PageLoad{{ $link->id }}, 'hideSubMenu': open{{ $link->id }} === false, 'showSubMenu': open{{ $link->id }} === true }" class="absolute z-10 -ml-4 mt-3 transform px-2 w-screen max-w-md sm:px-0 lg:ml-0 lg:left-1/2 lg:-translate-x-1/2">
                    <div class="rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden">
                      <div class="relative grid gap-6 bg-white px-5 py-6">
    

                        @foreach ($subMenuLinks as $subLink)
                          @if ($subLink->menuid == $link->id)
                            <a href="{{ url('/'.$subLink->slug) }}" class="-m-3 p-3 flex items-start rounded-lg hover:bg-gray-50">
                              <div class="ml-4">
                                <p class="text-base font-medium text-gray-900">
                                  {{ $subLink->label }}
                                </p>
                              </div>
                            </a>
                          @endif
                        @endforeach

                      </div>
                    </div>
                  </div>
                @endif
                </span>
              @endforeach        
            </div>
          </nav>
        </div>

        <!--
          Mobile menu, show/hide based on menu open state.

        -->
        <div :class="{ 'hide': !onPageLoad, 'hideMenu': !open, 'showMenu': open }" class="hide navMenu absolute z-20 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
            <div class="px-5 pt-4 flex items-center justify-between">
              <div>
                <a href="/"><h1 class="logo-text"><strong>KIMPAINT</strong></h1></a>
              </div>
              <div class="-mr-2">
                <button id="closeNavMenu" @click.prevent="open = !open" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 navButton hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                  <span class="sr-only">Close main menu</span>
                  <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
            <div class="navMenu-links px-2 pt-2 pb-3 space-y-1">
              @foreach ($menuLinks as $link)
                <!-- check if menu link contains submenu links -->
                @php
                  $hasSubLinks = false;
                @endphp
                @foreach ($subMenuLinks as $subLink)
                    @if ($subLink->menuid == $link->id)
                      @php $hasSubLinks = true; @endphp
                    @endif
                @endforeach

                <!-- also need to remove the link if it contains sublinks and add js to toggle the submenu -->

                <div class="navMenu-link-container" x-data="{ open{{ $link->id }}: false, PageLoad{{ $link->id }}: true}">
                  @if ($hasSubLinks)
                    
                    <a @click.prevent="PageLoad{{ $link->id }} = false, open{{ $link->id }} = !open{{ $link->id }}" class="navMenu-link block"><span :class="{ 'active': open{{ $link->id }} }" class="menuLinkStyle">{{ $link->label }}</span>
                      <i :class="{ 'hide': open{{ $link->id }} }" class="fas fa-angle-right text-gray-400 hover:text-gray-500"></i>
                      <i :class="{ 'hide': !open{{ $link->id }}, 'active': open{{ $link->id }} }" class="fas fa-angle-down text-gray-400 hover:text-gray-500"></i>
                    </a>

                  @else
                    <a href="{{ url('/'.$link->slug) }}" class="navMenu-link block"><span class="menuLinkStyle">{{ $link->label }}</span></a>
                  @endif
                  @if ($hasSubLinks)
                    <div class="subMenu-container" :class="{ 'hide': PageLoad{{ $link->id }}, 'hideSubMenu': !open{{ $link->id }}, 'showSubMenu': open{{ $link->id }} }">
                      @foreach ($subMenuLinks as $subLink)
                        @if ($subLink->menuid == $link->id)
                          <a href="{{ url('/'.$subLink->slug) }}" class="navMenu-subLink block">{{ $subLink->label }}</a>
                        @endif
                      @endforeach
                    </div>
                  @endif
                </div>
              @endforeach
            </div>
           
            <div class="mt-5 sm:mt-8 flex justify-center justify-start">
              <div class="rounded-md shadow">
                <a href="tel:+019053517947" class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange md:py-4 md:text-lg md:px-10">
                  <strong>Call or text 905-351-7947</strong>
                </a>
              </div>
            </div>

            <footer class="mt-5 menuFooter">
              <p>© 2022 Kim Painting. All rights reserved.</p>
              <p>Built by <a href="https://dallan.ca/">Dallan</a><p>
            </footer>
          </div>

      </div>
    
      <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
        <div class="sm:text-center lg:text-left">
          <h1 class="hero-title text-4xl tracking-tight font-extrabold text-gray-900 sm:text-5xl md:text-6xl">
            <span 
            class="block xl:inline opacity-0" 
            x-intersect="$el.classList.add('fadeInUp')">
              A fresh coat,
            </span>

            <span class="fadeIn delay-2 slideInRight block text-orange xl:inline">for a fresh start</span>
          </h1>
          <p x-intersect="$el.classList.add('fadeInUp')" class="opacity-0 delay-animation-2 body-text mt-3 text-base text-gray-500 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl lg:mx-0">
            Providing a fast, affordable and friendly painting service to the Niagara region.
          </p>
          <div x-intersect="$el.classList.add('fadeInUp')" class="opacity-0 delay-animation-2 mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
            <div class="delay-animation-3 bounce rounded-md shadow">
              <a href="contact-us" class="body-text w-full flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white bg-orange md:py-4 md:text-lg md:px-10">
                <strong>Get your free estimate</strong>
              </a>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>
  <div class="lg:absolute lg:inset-y-0 lg:right-0 lg:w-1/2">
    <img class="h-56 w-full object-cover sm:h-72 md:h-96 lg:w-full lg:h-full" src=" {{ 'img/hero.png' }}" alt="">
  </div>
</div>


<!-- CTA -->
<div class="flex flex-col .bg-footer-bg relative bg-cta-beige overflow-hidden">
  <div x-intersect="$el.classList.add('fadeInUp')" class="opacity-0 max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:items-center lg:justify-between relative z-10">
    <h2 class="about-us-title text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl lg:text-5xl">
      <span class="block">We're ready to paint</span>
      <span class="block text-orange">Across the entire Niagara region.</span>
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


<!-- About us -->
<div id="about" class="py-12 bg-white body-text bg-footer-bg">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <div class="flex flex-col lg:flex-row justify-between gap-32">
          <div x-intersect="$el.classList.add('fadeInUp')" class="opacity-0 w-full lg:w-5/12 flex flex-col justify-center">
              <h2 class="w-2/3 mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-orange">About us</h2>
              <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                  We offer expert painting and spraying, renovations, pressure washing and staining decks and fences. We also use the best paint and stain. We treat your home or business like it's ours. We stand behind the work we do.
              </p>
          </div>
          <div class="w-full lg:w-7/12">
              <img x-intersect="$el.classList.add('scale')" class="delay-animation-1 opacity-0 rounded-md w-full h-full drop-shadow-lg" src="img/hero2.jpg" alt="Painting a door using a roller" />
          </div>
      </div>
  
      <div class="flex lg:flex-row flex-col justify-between gap-32 pt-12">
          <div x-intersect="$el.classList.add('fadeInUp')" class="delay-animation-1 opacity-0 w-full lg:w-5/12 flex flex-col justify-center">
              <h2 class="w-2/3 mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl pb-4 border-b-4 border-orange">Our Story</h2>
              <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                  Kim has 10 years experience doing residential and commerical painting. Having taken courses at Niagara College for operating a business, it has truly helped her build a successful painting company.
              </p>
          </div>
          <div class="w-full lg:w-7/12 lg:pt-8">
              <div class="grid md:grid-cols-2 sm:grid-cols-2 grid-cols-1 lg:gap-4">
                  <div class="p-4 pb-6 flex justify-center flex-col items-center">
                      <img x-intersect="$el.classList.add('scale')" class="delay-animation-2 opacity-0 block rounded-md drop-shadow-lg" src="img/4.jpg" alt="Before picture of a house" />
                  </div>
                  <div class="p-4 pb-6 flex justify-center flex-col items-center">
                      <img x-intersect="$el.classList.add('scale')" class="delay-animation-2 opacity-0 block rounded-md drop-shadow-lg" src="img/3.jpg" alt="After picture of a exterior painted house" />
                  </div>
              </div>
          </div>
      </div>
          
  </div>
</div>


<!-- why choose us -->
<div class="py-12 body-text bg-gray-50" style="min-height:1100px">

    <!-- blob -->
    <div class="relative max-w-10xl mx-auto px-4 mb-20 sm:px-6 lg:px-8">
        <svg x-intersect="$el.classList.add('scale')" class="absolute" id="visual" viewBox="0 0 1200 900" width="1200" height="900" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"><rect x="0" y="0" width="1200" height="900" fill="transparent"></rect><g transform="translate(504.2547351738184 456.75594267026463)"><path d="M173.3 -307.7C221.2 -238.9 254.3 -185.1 270.7 -129.5C287 -73.8 286.5 -16.3 289.4 49.5C292.2 115.4 298.4 189.6 264.2 228.8C230.1 268.1 155.6 272.2 79.5 314.4C3.5 356.6 -74.2 436.9 -142.3 438.1C-210.3 439.3 -268.8 361.4 -328.4 287.4C-388.1 213.5 -448.9 143.4 -479.7 57.2C-510.4 -29 -511 -131.3 -451.4 -183C-391.8 -234.7 -271.9 -235.6 -186.7 -287.4C-101.4 -339.1 -50.7 -441.5 6 -450.9C62.7 -460.3 125.4 -376.5 173.3 -307.7" fill="#F8F5F1"></path></g></svg>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative z-10 max-w-screen-xl p-4 mx-auto px-4 sm:px-6 lg:px-8 py-26 lg:mt-20">
                <div class="lg:grid lg:grid-flow-row-dense lg:grid-cols-2 lg:gap-48 lg:items-center">
                    <div x-intersect="$el.classList.add('fadeInUp')" class="lg:col-start-2 lg:max-w-2xl ml-auto">
                        <h2 class="text-base text-orange font-semibold tracking-wide uppercase body-text">
                            Why choose us
                        </h2>
                        <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                            Because we have over ten years of experience.
                        </p>
                        <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                        We are passionate about painting homes and businesses, including interior & exterior. With excellent time management, colour and trend expertise we are able to provide you with a great affordable experience.
                        </p>
                        <a href="/contact-us" class="mt-8 shadow body-text w-1/2 flex items-center justify-center px-8 py-2 border border-transparent text-base font-medium rounded-md text-white bg-orange md:py-3 md:text-lg md:px-10">
                          <strong>Contact Us</strong>
                        </a>   
                    </div>
                    
                    <div class="mt-10 lg:-mx-4 lg:mt-0 lg:col-start-1">
                        <div class="space-y-4">
                            <div class="flex flex-col md:flex-row items-end justify-center lg:justify-start space-x-4">
                                <div x-intersect="$el.classList.add('fadeIn')" class="w-full delay-animation-1 opacity-0 scalehover rounded-md bg-white drop-shadow-lg w-full md:max-w-xs px-6 py-12 mb-8">
                                    <div class="w-20 h-20 relative mb-8">
                                        <div class="absolute top-0 right-0 bg-light-orange rounded w-16 h-16 mt-2 mr-1"></div>
                                        <div class="text-white absolute bottom-0 left-0 bg-orange rounded w-16 h-16 flex items-center justify-center mt-2 mr-3">
                                            <i class="text-3xl fas fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                                      Affordable Pricing  
                                    </p>
                                    <p class="mt-4 max-w-2xl text-lg text-gray-500 lg:mx-auto">
                                        Offering competitive pricing so you don't have to look elsewhere
                                    </p>
                                </div>

                                <div x-intersect="$el.classList.add('fadeIn')" class="delay-animation-2 opacity-0 scalehover rounded-md bg-white drop-shadow-lg w-full md:max-w-xs p-6 py-12 mb-4 md:mb-0">
                                  <div class="w-20 h-20 relative mb-8">
                                    <div class="absolute top-0 right-0 bg-light-orange rounded w-16 h-16 mt-2 mr-1"></div>
                                    <div class="text-white absolute bottom-0 left-0 bg-orange rounded w-16 h-16 flex items-center justify-center mt-2 mr-3">
                                        <i class="text-3xl fas fa-star"></i>
                                    </div>
                                  </div>
                                  <p class="mt-2 text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                                      Attention to Detail 
                                  </p>
                                  <p class="mt-4 max-w-2xl text-lg text-gray-500 lg:mx-auto">
                                      We pay close attention to trends, colours, and overall quality
                                  </p>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row items-start justify-center lg:justify-start md:space-x-4 md:ml-8">
                                <div x-intersect="$el.classList.add('fadeIn')" class="delay-animation-3 opacity-0 scalehover mt-175 rounded-md bg-white drop-shadow-lg w-full md:max-w-xs px-6 py-12 mb-8 md:mb-0">
                                    <div class="w-20 h-20 relative mb-8">
                                        <div class="absolute top-0 right-0 bg-light-orange rounded w-16 h-16 mt-2 mr-1"></div>
                                        <div class="text-white absolute bottom-0 left-0 bg-orange rounded w-16 h-16 flex items-center justify-center mt-2 mr-3">
                                            <i class="text-3xl fas fa-clock"></i>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                                        Time Efficient
                                    </p>
                                    <p class="mt-4 max-w-2xl text-lg text-gray-500 lg:mx-auto">
                                        With excellent time management, we will get the job done smoothly
                                    </p>
                                </div>

                                <div x-intersect="$el.classList.add('fadeIn')" class="delay-animation-4 opacity-0 scalehover rounded-md bg-white drop-shadow-lg w-full md:max-w-xs p-6 py-12 md:mt-1">
                                    <div class="w-20 h-20 relative mb-8">
                                        <div class="absolute top-0 right-0 bg-light-orange rounded w-16 h-16 mt-2 mr-1"></div>
                                        <div class="text-white absolute bottom-0 left-0 bg-orange rounded w-16 h-16 flex items-center justify-center mt-2 mr-3">
                                            <i class="text-3xl fas fa-address-card"></i>
                                        </div>
                                    </div>
                                    <p class="mt-2 text-2xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">
                                        Woman Owned  
                                    </p>
                                    <p class="mt-4 max-w-2xl text-lg text-gray-500 lg:mx-auto">
                                        We are not a franchise. We are a woman runned business with plenty of experience
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- services -->
<div class="py-20 bg-white body-text" id="services">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div x-intersect="$el.classList.add('fadeInUp')" class="opacity-0 lg:text-center">
      <h2 class="text-base text-orange font-semibold tracking-wide uppercase body-text">Services</h2>
      <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
        This is what we can do
      </p>
      <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
        We will come visit you and listen to what you would like us to do. We supply paint on us if needed. We take laser measurements for accurate pricing and we can determine how much paint we need.
      </p>
    </div>

    <div x-intersect="$el.classList.add('scale')" class="delay-animation-1 opacity-0 mt-10">
      <dl class="space-y-10 md:space-y-0 md:grid md:grid-cols-2 md:gap-x-8 md:gap-y-10">
        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-white text-2xl">
              <i class="fas fa-home"></i>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Residential</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            We will paint anything on a residential property. We provide free estimates and no job is too big or too small. Attention to detail.
          </dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-2xl text-white">
              <i class="fas fa-building"></i>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Commercial</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            Business, medical office, property management and more. Feel free to tell us what you have and what needs to be done.
          </dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-2xl text-white">
              <i class="fas fa-brush"></i>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Interior & exterior painting</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            Painting can enhance the appearance and value of your home or work place significantly.
          </dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-2xl text-white">            
              <i class="fas fa-pencil-alt"></i>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Drywall</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            Repairs and installation. We also do tapeing and sanding.
          </dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-2xl text-white">       
              <i class="fas fa-hammer"></i>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Desk & fence installation</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            We build and install fences and make sure it's securely installed.
          </dd>
        </div>

        <div class="relative">
          <dt>
            <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-2xl text-white">            
              <i class="fas fa-bolt"></i>
            </div>
            <p class="ml-16 text-lg leading-6 font-medium text-gray-900">Power washing & stain</p>
          </dt>
          <dd class="mt-2 ml-16 text-base text-gray-500">
            We restore your old wood fences, decks, pergolas and more using the best products.
          </dd>
        </div>
      </dl>
    </div>
  </div>
</div>

<!-- testimonials -->
@if (isset($testimonials))
  <div style="background-color:#f7f6f2" class="h-80 md:h-96 lg:h-80 py-12 w-full mx-auto overflow-hidden">
      <div class="flex items-center md:items-start flex-col md:flex-row justify-center">
          <div x-intersect="$el.classList.add('fadeInUp')" class="relative opacity-0 w-full md:w-2/3">
              @foreach ($testimonials as $testimonial)
              <div class="testimonial-slide max-w-7xl px-4 sm:px-6 lg:px-8 w-full">
                <p class="body-text text-gray-500 w-full md:w-2/3 m-auto text-left text-lg md:text-xl lg:text-2xl">
                    <span class="font-bold text-orange">“</span>
                    @php
                      $str = ltrim($testimonial->testimonial, '<div>');
                      $str = substr_replace($str ,"",-6);
                      @endphp
                    {{ $str }}
                    <span class="font-bold text-orange">”</span>
                </p>
                <div class="body-text flex mt-8 items-center justify-center">
                    <span class="font-semibold text-orange mr-2 text-lg">
                      {{ $testimonial->author}}
                    </span>
                </div>
              </div>
              @endforeach
          </div>
      </div>
  </div>
@endif


@php
$a=array("stock-1.jpg","stock-2.jpg","stock-3.jpg","hero.png","hero2.jpg", "hero3.jpg");
$random_keys=array_rand($a,4);
$counterOne = 0;
$counterTwo = 0;
@endphp

<!-- blogs and gallery -->
<div class="py-20 body-text bg-gray-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div x-intersect="$el.classList.add('scale')" class="opacity-0 lg:text-center">
      <h2 class="text-base text-orange font-semibold tracking-wide uppercase body-text">Portfolio</h2>
      <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
        Previous work and blogs
      </p>
      <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
        Here is a collection of our past work and blog posts. Click <a href="/posts" class="text-orange"><strong>here</strong></a> to view more content!
      </p>
    </div>

    <!-- blogs -->
    <div class="mt-10 hidden md:block">
        <div class="relative grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-8">
          @foreach ($recentBlogs as $post)
            <a class="flex flex-col" href="{{ url('posts/'.$post->slug) }}">
              <div class="portfolio-card">
                <!-- image -->
                <img class="portfolio-card-img" src="img/{{ $a[$random_keys[$counterOne]] }}" alt="Thumbnail for blog post"/>
                <!-- <p class="pt-4 portfolio-card-type">Blog</p> -->
                <!-- title -->
                <h2 class="portfolio-card-title">{{ $post->title }}</h2>
                <!-- short description -->
                <p class="portfolio-card-desc">{!! \Illuminate\Support\Str::limit($post->excerpt, 50, '...') !!}</p>
                <!-- read more -->
                <p class="portfolio-card-end">
                    READ MORE
                    <i class="fas fa-angle-double-right"></i>
                </p>
              </div>
            </a>
            @php
              $counterOne += 1;
            @endphp
          @endforeach
        </div>
    </div>

    <!-- slider images -->
    <div class="mt-10 md:hidden overflow-hidden">
      <div class="slider">

        <button class="btn-slide prev"><i class="fas fa-3x fa-chevron-left"></i></button>
        <button class="btn-slide next"><i class="fas fa-3x fa-chevron-right"></i></button>

        @foreach ($recentBlogs as $post)
          <div class="slide">
            <a href="{{ url('posts/'.$post->slug) }}">
              <div class="portfolio-card">
              
                <!-- image -->
                <img class="portfolio-card-img" src="img/{{ $a[$random_keys[$counterTwo]] }}" alt="Thumbnail for blog post"/>
                <!-- <p class="pt-4 portfolio-card-type">Blog</p> -->
                <!-- title -->
                <h2 class="portfolio-card-title">{{ $post->title }}</h2>
                <!-- short description -->
                <p class="portfolio-card-desc">{!! \Illuminate\Support\Str::limit($post->excerpt, 50, '...') !!}</p>
                <!-- read more -->
                <p class="portfolio-card-end">
                    READ MORE
                    <i class="fas fa-angle-double-right"></i>
                </p>
              
              </div>
            </a>
          </div>
          @php
            $counterTwo += 1;
          @endphp
        @endforeach

      </div>
      <div class="dots-container mt-6">
          @for ($i = 0; $i < count($recentBlogs); $i++)
            <span class="dot" data-slide="@php echo $i;  @endphp"></span>
          @endfor
      </div>
    </div>

  </div>
</div>

<x-footer />