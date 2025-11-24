      <div class="widget" style="max-height: 400px;">
          <h3>স্বাস্থ্য </h3>
          <ul class="news-list">
              @forelse ($healthNews as $item)
                  <li>
                    
                      <img src="{{ $item->featuredImage->file_path ? asset('storage/' . $item->featuredImage->file_path) : 'https://placehold.co/60x40' }}"
                          alt="{{ $item->title }}">
                      <span><a href="{{ route('singleNews', $item->slug) }}">{{ \Illuminate\Support\Str::limit($item->title, 32) }}</a></span>
                    
                  </li>

              @empty
                  <p>এই ক্যাটাগরিতে কোনো খবর পাওয়া যায়নি।</p>
              @endforelse


          </ul>
      </div>