    <main class="content">

            
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
          
          <a href="#">জ্বালানি</a>
          <a href="#">অর্থনীতি</a>
          <a href="#">সরকার</a>
        </div>
      </article>


    </main>
        
