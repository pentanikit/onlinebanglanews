

          <div class="section-title">
              <h2>{{ $catTitle }}</h2>
              <a href="#">সব খবর »</a>
          </div>
      <div class="news-grid">
          @forelse ($categoriesNews as $item)
              <a href="{{ route('singleNews', $item->slug) }}">

                  <article class="news-card" style="height: 480px;">
                       <img src="{{ asset('storage') . '/' . $item->featuredImage->file_path ?? '' }}"
                          style="width: 100%; height: 220px; object-fit:fill;" alt="{{ $item->title ?? 'Lead News' }}">
                      <h3>{{ $item->title }}</h3>
                      <p class="meta">{{ $item->author->name }}</p>
                      <p>{{ $item->excerpt }}</p>
                  </article>
              </a>

          @empty
              <p>এই ক্যাটাগরিতে কোনো খবর পাওয়া যায়নি।</p>
          @endforelse

      </div>
