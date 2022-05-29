<div class="mb-6">
    @include ('posts._search-form')
</div>

<div class="mb-8">
    <h2 class="mb-6 pb-2 border-b-4 border-orange text-3xl font-bold text-gray-900 body-text">
        Recent Posts
    </h2>
    <ul>
        @foreach ($recentPosts as $post)
            <li class="text-lg leading-6 font-medium text-gray-900 side-link">
                <a href="{{ $post->slug }}">{{ $post->title }}</a>
            </li>
        @endforeach
    </ul>
</div>

<div class="mb-8">
    <h2 class="mb-6 pb-2 border-b-4 border-orange text-3xl font-bold text-gray-900 body-text">
        Categories
    </h2>

    <x-category-list />
</div>