 @if ($international->isNotEmpty())
     @php
         $lead = $international->first(); // প্রথম নিউজ
         $second = $international[1];
         $others = $international->skip(2); // বাকি সব নিউজ
     @endphp

     <!-- Page Title -->
     
         <div class="section-title">
             <h2>{{ $catTitle }}</h2>
             <a href="#">সব খবর »</a>
         </div>
     

     <!-- Main Layout -->
     <div class="main-layout">
         <main class="content">
             <!-- Featured of this category -->


             <article class="lead-news">

                 <img src="{{ asset('storage') . '/' . $lead->featuredImage->file_path }}"
                         style="width: 100%; height: 240px;" alt="" srcset="">
                     <h2>{{ $lead->title }}</h2>
                    
                 

                 <p class="meta">{{ $lead->author->name }} | ১১ নভেম্বর ২০২৫</p>
                 <p class="excerpt">
                   {{ $lead->excerpt }}
                 </p>
             </article>





             <!-- Category listing -->
             <div class="category-list">
               
                    <article class="cat-item" >
                         <img src="{{ asset('storage') . '/' . $second->featuredImage->file_path }}"
                            style="width: 100%; height: 240px;" alt="" srcset="">
                        <h3><a href="{{ route('singleNews', $second->slug) }}">{{ $second->title }}</a></h3>
                        <p class="meta">{{ $second->author->name }} | ১১ নভেম্বর ২০২৫</p>
                        <p>{{ $second->excerpt }}</p>
                    </article>
              
                    
               

               
             </div>



         </main>

    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="widget">
        <h3>আরো দেখুন </h3>
        <ul class="list">
            @forelse ($others as $item)
                 <li><a href="{{ route('singleNews', $item->slug) }}">{{ $item->title }}</a></li>
            @empty
                <p>No more found</p>
            @endforelse
         
         
        </ul>
      </div>
      <div class="widget ad-widget">
        <span>300x250 AD</span>
      </div>
    </aside>
     </div>
 @else
     
     <p>কোনো নিউজ পাওয়া যায়নি।</p>
 @endif
