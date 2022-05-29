<div class="headerFixedBg hidden"></div>
    <div class="max-w-7xl mx-auto">
      <div class="relative z-20 pb-6 bg-white sm:pb-6 md:pb-6  lg:pb-6 xl:pb-6">
        <svg class="hidden lg:block absolute right-0 inset-y-0 h-full w-48 text-white transform translate-x-1/2" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none" aria-hidden="true">
          <polygon points="50,0 100,0 50,100 0,100" />
        </svg>

        <div class="header" x-data="{ open: false, onPageLoad:false }">
          <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
            <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
              <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
                <div class="flex items-center justify-between w-full md:w-auto">
                  <a href="/">
                    <span class="sr-only">Workflow</span>
                    <!-- <img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg"> -->
                    <h1 class="logo-text"><strong>KIMPAINT</strong></h1>
                  </a>
                  <div class="-mr-2 flex items-center md:hidden">
                    <button id="openNavMenu" @click.prevent="open = !open, onPageLoad = true" type="button" class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 navButton hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
                      <span class="sr-only">Open main menu</span>
                      <!-- Heroicon name: outline/menu -->
                      <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                      </svg>
                    </button>
                  </div>
                </div>
              </div>
              <!-- desktop nav menu -->
              <div class="hidden relative md:block md:ml-10 md:pr-4 md:space-x-8 relative">
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
                                  <p class="text-base font-normal text-gray-900">
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

            Entering: "duration-150 ease-out"
              From: "opacity-0 scale-95"
              To: "opacity-100 scale-100"
            Leaving: "duration-100 ease-in"
              From: "opacity-100 scale-100"
              To: "opacity-0 scale-95"
          -->
          <div :class="{ 'hide': !onPageLoad, 'hideMenu': !open, 'showMenu': open }" class="hide navMenu absolute z-20 top-0 inset-x-0 p-2 transition transform origin-top-right md:hidden">
            <!-- <div class="rounded-lg shadow-md bg-white ring-1 ring-black ring-opacity-5 overflow-hidden"> -->
              <div class="px-5 pt-4 flex items-center justify-between">
                <div>
                  <!-- <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt=""> -->
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
                    Call or text 905-351-7947
                  </a>
                </div>
              </div>

              <footer class="mt-5 menuFooter">
                <p>© 2022 Kim Painting. All rights reserved.</p>
                <p>Built by <a href="https://dallan.ca/">Dallan</a><p>
              </footer>
            </div>

          
          <!-- </div> -->
        </div>
      </div>
    </div>
  </div>
  