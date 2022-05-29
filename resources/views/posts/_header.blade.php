<header class="bg-white">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-5xl font-bold text-gray-900 body-text">
         
            @if (Request::is('posts') && !Request::query('category') && !Request::query('author'))
                All Posts
            @elseif (Request::query('category') && !Request::query('author'))
                {{ ucwords($category->name) }} Posts

            @elseif (Request::query('author') && !Request::query('category'))
                Posts by {{ ucwords($author->name) }}

            @elseif (Request::query('author') && Request::query('category'))
                {{ ucwords($category->name) }} Posts by {{ ucwords($author->name) }}
            @elseif (Request::is('contact-us'))
                Contact Us
            @endif
        </h1>
    </div>
</header>