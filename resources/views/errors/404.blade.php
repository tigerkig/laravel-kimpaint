<x-layout>

    <x-nav-menu />

    @include ('posts._bread-crumb')
    
    @include ('posts._header')

    <main
    aria-labelledby="pageTitle"
    class="flex justify-center my-64"
    >
        <div class="p-4 space-y-4">
          <div class="flex flex-col items-start space-y-3 sm:flex-row sm:space-y-0 sm:items-center sm:space-x-3">
            <p class="font-semibold text-orange text-9xl">404</p>
            <div class="space-y-2">
              <h1 id="pageTitle" class="flex items-center space-x-2">
                <span class="text-xl font-medium text-gray-600 sm:text-2xl dark:text-light">
                  Oops! Page not found.
                </span>
              </h1>
              <p class="text-md leading-6 font-normal text-gray-400">
                The page you are looking for was not found.
              </p>
              <p class="text-md leading-6 font-normal text-gray-400">
                You may return to
                <a href="/" class="text-orange hover:underline">home page</a> or try
                using the search form.
              </p>
            </div>
          </div>

            <form method="GET" action="/posts/">
                <div class="input-group relative flex items-stretch w-full mb-4">
                    <input type="text" class="form-control relative flex-auto min-w-0 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded-l-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        name="search"
                        id="search" 
                        placeholder="Search blog posts"
                        value="{{ request('search') }}"
                        aria-label="Search" 
                        aria-describedby="button-addon2"
                    >
                    <button type="submit" class="btn inline-block px-6 py-2.5 bg-orange text-white font-medium text-xs leading-tight uppercase rounded-r-lg shadow-md hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-orange-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="button" id="button-addon2">
                        <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <script src="./js/slider.js"></script>
</x-layout>