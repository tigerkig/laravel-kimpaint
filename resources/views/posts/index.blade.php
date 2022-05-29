<x-layout>

    <x-nav-menu />

    @include ('posts._bread-crumb')
    
    @include ('posts._header')

    <main>
        <div class="max-w-7xl mx-auto p-4 py-6 sm:px-6 lg:px-8">
            
            <!-- category list -->
            <aside class="mb-6">
                <x-category-list />
            </aside>


            <aside class="form-floating mb-3 max-w-lg body-text">
                @include ('posts._search-form')
            </aside>
    
            @if ($posts->count())
                @foreach($posts as $post)
                <article class="{{ $loop->even ? 'bg-gray' : '' }} body-text">  

                    <!-- date -->
                    <p class="blog-posts-date">
                        <a href="/posts/{{ $post->slug }}">
                            {{ date('F d, Y', strtotime($post->created_at)) }}
                            &#8226;
                            {{ $post->created_at->diffForHumans() }}
                        </a>
                    </p>
                    
                    <!-- title -->
                    <h2 class="blog-posts-title">
                        <a href="/posts/{{ $post->slug }}">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- author/category -->
                    <p class="blog-posts-author">
                        By
                        <a href="/posts/?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                        in
                        <a href="/posts/?category={{ $post->category->slug }}">
                            {{ $post->category->name }}
                        </a>
                    </p>

                    <!-- body -->
                    <p class="blog-posts-excerpt">{!! $post->excerpt !!}</p>

                </article> 
                @endforeach
            @else
                <p>There aren't any blog posts yet!</p>
            @endif

            <aside class="my-8">
                {{ $posts->links() }}
            </aside>

        </div>
    </main>
    <script src="./js/slider.js"></script>
</x-layout>