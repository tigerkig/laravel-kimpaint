<nav class="bg-gray-100 py-3 rounded-md w-full">
    <ol class="list-reset flex max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <li><a href="/" class="bread-crumb">Home</a></li>
        <li><span class="text-gray-500 mx-2">/</span></li>
    
        <!-- when viewing a post -->
        @if (Request::is('posts/*'))
            <li><a href="/posts" class="bread-crumb">Blog</a></li>
            <li><span class="text-gray-500 mx-2">/</span></li>
            <li class="text-gray-500">Blog</li>
            {{ $post->title }}
        @elseif (Request::is('posts'))
            <li class="text-gray-500">Blog</li>
        @elseif (Request::is('contact-us'))
            <li class="text-gray-500">Contact Us</li>
        @endif
        
    </ol>

    
</nav>