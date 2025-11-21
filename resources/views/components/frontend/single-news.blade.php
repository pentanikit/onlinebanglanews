    <main class="content">

      {{-- @dd($singlePost->tags[0]->name) --}}
            
      <article class="single-post">
        <h1>{{ $singlePost->title }}</h1>
        <p class="single-meta">{{ $singlePost->author->name ?? 'স্টাফ রিপোর্টার' }}</p>
        <img src="{{ asset('storage').'/'.$singlePost->featuredImage->file_path }}" style="max-width: 600px; height:400px;" class="single-cover" alt="">

        <div class="single-body">
            {{ $singlePost->excerpt }}
        </div>

        <!-- Tags / category -->
      <div class="single-tags">
          <span>ট্যাগ:</span>

          @if (($singlePost->tags)->isNotEmpty())
              @foreach (explode(',', $singlePost->tags[0]->name) as $tag)
                  @php $tag = trim($tag); @endphp

                  @if($tag !== '')
                     
                      <a href="#">{{ $tag }}</a>

                      {{-- যদি ট্যাগ পেজ থাকে, তাহলে এমনও করতে পারো:
                      <a href="{{ route('tag.posts', ['tag' => $tag]) }}">{{ $tag }}</a>
                      --}}
                  @endif
              @endforeach
          @else
          <p>No tags found</p>
          @endif
      </div>

      </article>


    </main>
        
