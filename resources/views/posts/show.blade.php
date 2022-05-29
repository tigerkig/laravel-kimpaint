<x-layout>

    <x-nav-menu />

    @include ('posts._bread-crumb')

    <main class="p-4 sm:p-0 body-text">
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            
            <a class="bread-crumb" href="/posts">< BACK TO BLOG</a>

            <div class="flex flex-col md:flex-row gap-10">
                <article class="flex-1 post-container">
<!-- <img src="{{ asset('storage/galleries/nxfcVFuxV85pEINTLnQUo0Wbo1XQgpoSUCe66RnQ.jpg') }}" /> -->
                    <h1 class="text-5xl font-bold text-gray-900 pb-6">{{ $post->title }}</h1>

                    <p class="blog-posts-author">
                        By
                        <a href="/posts/?author={{ $post->author->username }}">{{ $post->author->name }}</a>
                        in 
                        <a href="/posts/?category={{ $post->category->slug }}">
                            {{ $post->category->name }}
                        </a>
                        on
                        {{ date('F d, Y', strtotime($post->created_at)) }}
                    </p>

                    <div>
                    {!! html_entity_decode($post->body) !!}
                    </div>
                </article>

                <aside class="md:mt-20 md:w-60 lg:w-80 mb-20">
                    @include ('posts._side-menu')
                </aside>
            </div>

        </div>
    </main>
</x-layout>