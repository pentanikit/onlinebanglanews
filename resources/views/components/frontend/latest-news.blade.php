      <div class="widget">
          <h3>সর্বশেষ <span class="blinking-dot"></span></h3>
          <ul class="news-list">
              @forelse ($latest as $item)
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

      <style>
          .blinking-dot {
              height: 12px;
              width: 12px;
              background-color: red;
              border-radius: 50%;
              display: inline-block;
              margin-right: 6px;
              animation: blink 1s infinite;
          }

          @keyframes blink {
              0% {
                  opacity: 1;
              }

              50% {
                  opacity: 0;
              }

              100% {
                  opacity: 1;
              }
          }


      </style>
