      <div class="widget" style="width: 300px;">
        <h3>সর্বশেষ</h3>
        <ul class="list">
            @forelse ($latest as $item)
                <li><a href="{{ route('singleNews', $item->slug) }}">{{ $item->title }}</a></li>
            @empty
                 <p>এই ক্যাটাগরিতে কোনো খবর পাওয়া যায়নি।</p>
            @endforelse
          
        
        </ul>
      </div>