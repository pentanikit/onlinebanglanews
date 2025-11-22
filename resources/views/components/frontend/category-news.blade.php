

          <div class="section-title">
              <h2>{{ $catTitle }}</h2>
              <a href="{{ route('singleNews', $catTitle) }}">সব খবর »</a>
          </div>
      <div class="news-grid">
          @forelse ($categoriesNews as $item)
              <a href="{{ route('singleNews', $item->slug) }}">

                  <article class="news-card" style="height: 480px;">
                       <img src="{{ asset('storage') . '/' . $item->featuredImage->file_path ?? '' }}"
                          style="width: 100%; height: 220px; object-fit:fill;" alt="{{ $item->title ?? 'Lead News' }}">
                      <h3>{{ $item->title }}</h3>
                      <p class="meta">{{ $item->author->name }} | {{ \App\Helpers\BanglaDate::format($item->created_at) }}</p>
                      <p>{{ \Illuminate\Support\Str::limit($item->excerpt, 250) }}</p>
                  </article>
              </a>

          @empty
              <p>এই ক্যাটাগরিতে কোনো খবর পাওয়া যায়নি।</p>
          @endforelse

      </div>
