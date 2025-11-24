<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
  <title>About Eimager</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <script src="{{ asset('js/app.js') }}"></script>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{url('/images/favicon.ico')}}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

</head>

<body class="bg-gray-50 text-gray-900 font-sans">
  
<!-- bg-gradient-to-t from-[#01c6ce] to-[#0e48db] -->
  <section class="relative  bg-gradient-to-r from-teal-600 to-blue-400 text-white py-5 px-6 text-center">
    <header>
    <div class="header-content">
      <div class="logo">
        <a href="/"><img src="{{url('/images/logo.jpg')}}" alt="Company Logo"></a>

      </div>
      <nav class="main-nav">
        <ul>
          <!-- navbar -->
          <!-- <li><a href="{{ route('register-page') }}">Employee Signup</a></li> -->
          <!-- <li><a href="{{ route('hr-register-page') }}">Employer Signup</a></li> -->
          <li><a href="{{ route('login-page') }}">Employee Login</a></li>
          <li><a href="{{ route('hr-login-page') }}" class="login-cta">Employer Login</a></li>
        </ul>
      </nav>
    </div>
    <div class="mobile-logo-menu-wrapper">
      <div class="center-nav-logo-holder-moble">
        <a href="/"><img src="{{url('/images/logo.jpg')}}" alt="Company Logo"></a>
      </div>
      <div class="hamburger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    </div>
    <!-- mobile-menu -->
    <div class="mobile-menu-holder">
      <div class="cross-wrapper">
        <a href="/about" class="close-icon">x</a>
      </div>
      <div class="left-nav-menu-holder">
        <ul class="list-left">

          <!-- <li><a href="{{ route('register-page') }}">Employee Signup</a></li> -->
          <!-- <li><a href="{{ route('hr-register-page') }}">Employer Signup</a></li> -->
          <li><a href="{{ route('login-page') }}">Employee Login</a></li>
          <li><a href="{{ route('hr-login-page') }}" class="login-cta">Employer Login</a></li>
        </ul>
      </div>
    </div>
    </header>
    <h1 class="text-5xl font-extrabold max-w-4xl mx-auto mb-6">Empowering Trust in Every Hire</h1>
    <p class="text-xl max-w-3xl mx-auto mb-10 opacity-90 ">Eimager is revolutionizing employee verification by making it
      fast, secure, and universally accessible. We help organizations eliminate hiring risks and empower professionals
      to showcase verified credibility—building a future where trust is the default, not the exception.</p>
    <a href="#whyeimager"
      class="inline-block px-8 py-3 bg-white text-blue-700 font-semibold rounded-lg hover:bg-blue-100 transition">Learn
      More</a>
  </section>
  <section class="bg-gradient-to-b from-white to-gray-50 py-16 px-6 md:px-20">
    <se class="max-w-6xl mx-auto">

      <!-- Mission & Vision -->
      <div class="grid md:grid-cols-2 gap-10 mb-16">
        <div class="bg-white p-8 rounded-xl shadow-xl shadow-cyan-500/50">
          <h2 class="text-2xl underline font-semibold text-blue-600 mb-2">Our Mission</h2>
          <p class="text-gray-700">
            To redefine workforce integrity by enabling instant, error-free employee verification for every
            organization—regardless of size, sector, or geography. We believe that trust should be built
            into every hire, not bolted on after.
          </p>
        </div>
        <div class="bg-white p-8 rounded-xl shadow-xl shadow-cyan-500/50">
          <h2 class="text-2xl underline font-semibold text-blue-600 mb-2">Our Vision</h2>
          <p class="text-gray-700">
            A world where every employee is verified, every employer is confident, and every workplace
            thrives on transparency, accountability, and mutual respect.
          </p>
        </div>
      </div>

      <!-- Features -->
      <div id="whyeimager" class="mb-16">
        <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">Why Eimager?</h2>
        <div class="grid md:grid-cols-3 gap-8">
          <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition shadow-cyan-500/50">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">⚡ Instant Verification</h3>
            <p class="text-gray-600">100% automated checks with 0% error rates—no delays, no manual
              bottlenecks.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition shadow-cyan-500/50">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">🔐 Certified Security</h3>
            <p class="text-gray-600">SOC 2 Type II, ISO 27001 & ISO 27701 certified for enterprise-grade
              data protection.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition shadow-cyan-500/50">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">📊 Smart Dashboards</h3>
            <p class="text-gray-600">Track verification status, manage reports, and streamline hiring from
              one MIS dashboard.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition shadow-cyan-500/50">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">🌍 Global Reach</h3>
            <p class="text-gray-600">Support for 25+ industries across borders—tailored to compliance-heavy
              and dynamic sectors.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition shadow-cyan-500/50">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">🔁 Two-Way Verification</h3>
            <p class="text-gray-600">Verify employees at both joining and exit—preventing disputes and
              protecting reputation.</p>
          </div>
          <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition shadow-cyan-500/50">
            <h3 class="text-xl font-semibold text-blue-600 mb-2">📞 24x7 Support</h3>
            <p class="text-gray-600">Live chat, email, and phone support—because trust should never be
              offline.</p>
          </div>
        </div>
      </div>

      <!-- Industries -->
      <div class="mb-16 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">Industries We Serve</h2>
        <p class="text-gray-600 mb-6 max-w-3xl mx-auto">
          From IT to healthcare, finance to aviation—Eimager supports 25+ industries with tailored
          verification solutions. Whether you're hiring for compliance-heavy roles or customer-facing teams,
          we’ve got you covered.
        </p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-gray-700 text-sm">
          <span>🏥 Healthcare</span><span>💻 IT & Tech</span><span>🏦 Finance & Banking</span><span>🏗️
            Construction</span>
          <span>✈️ Aviation</span><span>🛍️ Retail & Lifestyle</span><span>🏨 Hospitality</span><span>📞
            BPO</span>
          <span>🏫 Education</span><span>🧪 Pharmaceutical</span><span>🚚 Logistics</span><span>🧵
            Textile</span>
        </div>
      </div>

      <!-- Hero -->
      <section class="bg-gradient-to-b from-white to-gray-100">
        <h2 class="text-3xl font-bold text-gray-800 mb-4 text-center">Mind Behind Innovation</h2>
        <div class="max-w-6xl mx-auto px-4 py-10 md:py-2 grid md:grid-cols-[auto,1fr] gap-6">
          <div class="flex md:block md:pt-2">
            <img
              src="https://media.licdn.com/dms/image/v2/D4D03AQHrvgm-VQTVMQ/profile-displayphoto-shrink_400_400/profile-displayphoto-shrink_400_400/0/1699173272886?e=1762992000&v=beta&t=DKJfKURIc4nu-IW4ibUTU3eeD0UqBbGyPYlXwTLLrS0"
              alt="Er. Prabhakar Dwivedi" class="w-28 h-28 md:w-36 md:h-36 rounded-full ring-4 ring-white shadow" />
          </div>
          <div>
            <h1 class="text-2xl md:text-4xl font-extrabold tracking-tight">Er. Prabhakar Dwivedi</h1>
            <p class="mt-2 text-gray-700 text-base md:text-lg">
              Founder & CEO — <span class="font-semibold">Eimager.com</span> | PD Consulting Engineers
              Pvt. Ltd. | Ultimate iTech Pvt Ltd | Indian Trade Mart
            </p>
            <div class="mt-4 flex flex-wrap gap-2">
              <span class="px-3 py-1 text-xs bg-blue-50 text-blue-700 rounded-full">Entrepreneur</span>
              <span class="px-3 py-1 text-xs bg-emerald-50 text-emerald-700 rounded-full">Investor</span>
              <span class="px-3 py-1 text-xs bg-purple-50 text-purple-700 rounded-full">Chartered
                Structural Engineer</span>
              <span class="px-3 py-1 text-xs bg-amber-50 text-amber-700 rounded-full">Chartered
                Valuer</span>
            </div>

          </div>
        </div>
      </section>

      <!-- About -->
      <section id="about" class="max-w-6xl mx-auto px-4 py-10">
        <h2 class="text-xl md:text-2xl font-bold">About</h2>
        <p class="mt-3 text-gray-700 leading-relaxed">
          Er. Prabhakar Dwivedi is a multifaceted founder and leader building platforms and businesses across
          background verification, engineering, infrastructure, real estate, technology, and media.
          At <span class="font-semibold">Eimager.com</span>, he champions trust and transparency in hiring
          through
          technology-driven employee background verification. His engineering pedigree underpins strategic
          execution
          and value creation across ventures.
        </p>
      </section>


      <!-- Highlights -->
      <section id="highlights" class="max-w-6xl mx-auto px-4 py-10">
        <h2 class="text-xl md:text-2xl font-bold">Professional Highlights</h2>
        <ul class="mt-4 space-y-3 text-gray-700">
          <li class="flex gap-3"><span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span> Chartered
            Structural Engineer with experience across infrastructure and real estate projects.</li>
          <li class="flex gap-3"><span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span> Championing
            compliant, scalable background verification for trusted hiring.</li>
          <li class="flex gap-3"><span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span> Active investor
            and advisor in technology-led ventures.</li>
        </ul>
      </section>
<!-- bg-gradient-to-t from-[#01c6ce] to-[#0e48db] -->
  </section>
  <footer class="bg-gradient-to-r from-teal-600 to-blue-400  text-white body-font font-medium bg-gray-100">
    <div class=" container px-5 py-10 mx-auto">
      <div class="flex flex-wrap md:text-left text-left order-first">
        <div class="lg:w-2/5 md:w-1/2 w-full px-4">
          <h2 class="title-font font-bold text-white tracking-widest text-lg mb-3">Contact Us</h2>
          <nav class="list-none mb-10">
            <li><span>Support :</span> <a href="mailto:support@eimager.com">support@eimager.com</a></li>
            <li><span>Kyc :</span> <a href="mailto:kyc@eimager.com"> kyc@eimager.com</a></li>
            <li><span>Legal Issues :</span> <a href="mailto:legal@eimager.com"> legal@eimager.com</a>
            </li>
            <li><span>Marketing :</span> <a href="mailto:marketing@eimager.com">
                marketing@eimager.com</a></li>
            <li><span>Business Collaboration :</span> <a href="mailto:business@eimager.com">
                business@eimager.com</a></li>
            <li><span>Jobs Related Query :</sapn> <a href="mailto:hr@eimager.com"> hr@eimager.com</a>
            </li>
          </nav>
        </div>
        <div class="lg:w-1/5 md:w-1/2 w-full px-4 ">
          <h2 class="title-font font-bold text-white tracking-widest text-lg mb-3">Explore Us</h2>
          <nav class="list-none mb-10">
            <li><a href="/">Home</a></li>
            <li><a href="/about">About Us</a></li>
            <li><a href="/#contact">Enquiry</a></li>
            <!-- <li><button id="cbb" class="text-white">Career</button></li> -->
          </nav>
        </div>
        <div class="lg:w-1/5 md:w-1/2 w-full px-4">
          <h2 class="title-font font-bold text-white tracking-widest text-lg mb-3">Quick links</h2>
          <nav class="list-none mb-10">
            <li><a href="{{ route('register-page') }}">Employee Signup</a></li>
            <li><a href="{{ route('hr-register-page') }}">Employer Signup</a></li>
            <li><a href="{{ route('login-page') }}">Employee Login</a></li>
            <li><a href="{{ route('hr-login-page') }}">Employeer Login</a></li>
            <li><a href="{{ route('admin-login') }}">Admin</a></li>
          </nav>
        </div>
        <div class="lg:w-1/5 md:w-1/2 w-full px-4">
          <h2 class="title-font font-bold text-white tracking-widest text-lg mb-3">Know more</h2>
          <nav class="list-none mb-10">
            <li><a href="mailto:info@eimager.com">info@eimager.com</a></li>
            <li><a href="mailto:bd@eimager.com">bd@eimager.com</a></li>
            <li><a href="tel:7290000451">+91 7290070051</a></li>
            <li><a href="tel:7290000453">+91 7290000453</a></li>

          </nav>
        </div>
      </div>

    </div>
    <div class="blog-landing-footer-bottom-menu">
      <div class="container">
        <div class="footer-bottom-wrapper">
          <p class="ml-10">Copyright &copy; 2025 Eimager || All Rights Reserved.</p>
          <div class="social-media-menu">
            <ul>
              <li><a href="https://www.facebook.com/EimagerOfficial" target="_blank"><img
                    src="{{url('/images/f-icon.png')}}"></a></li>
              <li><a href="https://www.instagram.com/eimagerofficial/" target="_blank"><img
                    src="{{url('/images/instra-icon.png')}}"></a></li>
              <li><a href="https://www.youtube.com/@eimagerOfficial" target="_blank"><img
                    src="{{url('/images/youtube-icon.png')}}"></a></li>
              <li><a href="https://x.com/EimagerOfficial/" target="_blank"><img
                    src="{{url('/images/twitter-icon-2.png')}}"></a></li>
              <li><a href="https://www.linkedin.com/company/eimager-official/" target="_blank"><img
                    src="{{url('/images/in-icon.png')}}"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>

</body>

</html>
<script>
      $(document).ready(function () {
        $(".hamburger").click(function () {
            $(".mobile-menu-holder").toggleClass("slide_sec");
        });
        $(".close-icon").click(function () {
            $(".mobile-menu-holder").removeClass("slide_sec");
        });
    });
</script>