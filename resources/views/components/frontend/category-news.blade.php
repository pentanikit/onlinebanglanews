      <!-- Category Block -->
      <section class="category-block " style="margin-bottom: 20px;">
        <div class="section-title">
          <h2>{{ $catTitle }}</h2>
          <a href="#">সব খবর »</a>
        </div>
        <div class="category-grid">
            @forelse ($categoriesNews as $item)
                <article>
                    <img src="{{ asset('storage').'/'. $item->featuredImage->file_path ?? '' }}" style="max-width: 240px; height: auto; object-fit:cover;" alt="{{ $item->title ?? 'Lead News' }}">
                    <h4>{{ $item->title }}</h4>
                    <p>{{ $item->excerpt }}</p>
                </article>
            @empty
                 <p>এই ক্যাটাগরিতে কোনো খবর পাওয়া যায়নি।</p>
            @endforelse


        </div>
      </section>