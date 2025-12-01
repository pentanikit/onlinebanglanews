<!DOCTYPE html>
<html lang="bn">

<head>
    <meta charset="UTF-8">
       
    <title>
        @yield('meta_title', seo_setting('site_meta_title', 'অনলাইন বাংলা '))
    </title>

    <meta name="description"
          content="@yield('meta_description', seo_setting('site_meta_description', 'অনলাইন বাংলা নিউজ – নির্ভরযোগ্য অনলাইন বাংলা সংবাদ পোর্টাল।'))">

    <meta name="keywords"
          content="@yield('meta_keywords', seo_setting('site_meta_keywords', 'অনলাইন বাংলা নিউজ, বাংলা খবর'))">

 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon"
        href="{{ favicon() }}">
    <!-- Google Font (optional) -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@400;500;700&display=swap"
        rel="stylesheet">
    <style>
        .news-list {
            list-style: disc;
            /* keeps native bullets */
            padding-left: 1.3rem;
            /* spacing for bullets */
            margin: 0;
            overflow-y: scroll;

            max-height: 400px;
        }

        .news-list li {
            display: flex;
            align-items: center;
            /* vertical center image + title */
            gap: 10px;
            /* space between image and title */
            margin-bottom: 1rem;
            /* spacing between list items */
        }

        .news-list li img {
            width: 60px;
            height: 40px;
            object-fit: cover;
            /* ensures image fills the box */
            border-radius: 4px;
            /* optional rounded corners */
            flex-shrink: 0;
            /* prevent image from shrinking */
        }

        .news-list li span {
            font-weight: 600;
            font-size: 0.8rem;
            line-height: 1.2;
            /* optional: truncate long titles */
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .widget.ad-widget {
          width: 100%;
          height: 250px;
          overflow: hidden;        /* hide cropped parts */
        }

        .widget.ad-widget img {
          width: 100%;
          height: 100%;
          object-fit: contain;       /* fill & crop */
          display: block;
        }

    </style>
</head>

<body>
    <!-- Top Bar -->
    {{-- <div class="topbar">
        <div class="container topbar-inner">
            <div class="top-left">
                {{ \Carbon\Carbon::now('Asia/Dhaka')->locale('bn')->isoFormat('dddd, DD MMMM YYYY') . ' | ঢাকা' }}

            </div>

            <div class="top-right">
                <div id="bd-clock" style="font-size: 18px;"></div>
            </div>

        </div>
    </div> --}}
    <!-- Header -->
    <x-frontend.header />
    <!-- Nav -->
    <x-frontend.navigation />

    @yield('pages')

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-inner">
            <p>© কপিরাইট <?php echo date('Y'); ?> অনলাইন বাংলা নিউজ </p>
            <p>কারিগরি সহায়তায়: Pentanik IT</p>
        </div>
    </footer>
    {{-- <script>
        function banglaClock() {
            const options = {
                timeZone: 'Asia/Dhaka',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            };
            let time = new Intl.DateTimeFormat('en-US', options).format(new Date());

            // Convert English digits + AM/PM to Bangla
            const map = {
                '0': '০',
                '1': '১',
                '2': '২',
                '3': '৩',
                '4': '৪',
                '5': '৫',
                '6': '৬',
                '7': '৭',
                '8': '৮',
                '9': '৯',
                'AM': 'সকাল',
                'PM': 'অপরাহ্ন'
            };

            // Replace digits
            time = time.replace(/\d/g, d => map[d]);
            // Replace AM/PM
            time = time.replace(/AM|PM/g, ap => map[ap]);

            document.getElementById('bd-clock').innerText = time;
        }

        // Initial run + update every second
        banglaClock();
        setInterval(banglaClock, 1000);
    </script> --}}
</body>

</html>
