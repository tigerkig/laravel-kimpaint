<ul class="flex gap-2 flex-wrap">

    @if ($url === 'posts')
        @if (isset($currentCategory))
            <a href="/posts/?{{ http_build_query(request()->except('category')) }}">
                <li 
                class="category-tab-bg p-1 rounded-md drop-shadow-lg category-tab-bg-notactive"
                >
                    <strong>SHOW ALL</strong>       
                </li>
            </a>
        @else
            <li 
            class="category-tab-bg p-1 rounded-md drop-shadow-lg category-tab-bg-active"
            >   
                <strong>SHOW ALL</strong>       
            </li>
        @endif
    @endif
    
    @foreach ($categories as $category)
        @if (isset($currentCategory) && $currentCategory->name == $category->name)
            <li 
            class="category-tab-bg p-1 rounded-md drop-shadow-lg category-tab-bg-active"
            >   
                <strong>{{ strtoupper($category->name) }}</strong>       
            </li>
        @else
            <a href="/posts/?category={{ $category->slug }}&{{ http_build_query(request()->except('category')) }}">
                <li 
                class="category-tab-bg p-1 rounded-md drop-shadow-lg category-tab-bg-notactive"
                >
                    <strong>{{ strtoupper($category->name) }}</strong>       
                </li>
            </a>
        @endif
    @endforeach
</ul>