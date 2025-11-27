 @if ($international->isNotEmpty())
     @php
         $lead = $international->first(); // প্রথম নিউজ
         $second = $international[1];
         $others = $international->skip(2); // বাকি সব নিউজ
     @endphp

     <!-- Page Title -->

     <div class="section-title">
         <h2>{{ $catTitle }}</h2>
         <a href="{{ route('categorywisenews', $catTitle) }}">সব খবর »</a>
     </div>


     <!-- Main Layout -->
     <div class="main-layout">
         <main class="content">
             <!-- Featured of this category -->


             <article class="lead-news">
                <a href="{{ route('singleNews', $lead->slug) }}">

                 <img src="{{ asset('storage') . '/' . $lead->featuredImage->file_path }}"
                     style="width: 100%; height: 240px; object-fit:contain;" alt="" srcset="">
                 <h2>{{ $lead->title }}</h2>



                 <p class="meta" style="font-size: 10px;">{{ $lead->author->name }} | {{ \App\Helpers\BanglaDate::format($lead->created_at) }}</p>
                 <p class="excerpt">
                      {{ $lead->excerpt ?? Str::limit(strip_tags($lead->excerpt), 220) }}
                 </p>
                </a>
             </article>





             <!-- Category listing -->
             <div class="category-list">

                 <article class="cat-item" >
                    <a href="{{ route('singleNews', $second->slug) }}"></a>
                     <img src="{{ asset('storage') . '/' . $second->featuredImage->file_path }}"
                         style="width: 100%; height: 240px;" alt="" srcset="">
                     <h3><a href="{{ route('singleNews', $second->slug) }}">{{ $second->title }}</a></h3>
                     <p class="meta">{{ $second->author->name }} | {{ \App\Helpers\BanglaDate::format($second->created_at) }}</p>
                     <p> {{ $second->excerpt ?? Str::limit(strip_tags($second->excerpt), 250) }}</p>
                 </article>





             </div>



         </main>

         <!-- Sidebar -->
         <aside class="sidebar">
             <div class="widget" >
                 <h3>আরো দেখুন </h3>
                    <ul class="news-list">
                        @forelse ($others as $item)
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
                   @php $ad = ad6('home_sidebar'); @endphp
                    @if($ad && $ad->image)
                        <div class="widget ad-widget">
                         <a href="{{ $ad->url }}">
                            <img src="{{ asset('storage/'.$ad->image) }}" alt="Ad 6">
                         </a>
                        </div>
                    @endif
              <x-frontend.health-news />
         </aside>
        
     </div>
 @else
     <p>কোনো নিউজ পাওয়া যায়নি।</p>
 @endif
