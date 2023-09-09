<script>// Set the date we're counting down to
  var countDownDate = new Date("Sept 07, 2023 10:00:00").getTime();

  // Update the count down every 1 second
  var x = setInterval(function () {

    // Get todays date and time
    var now = new Date().getTime();

    // Find the distance between now and the count down date
    var distance = countDownDate - now;

    // Time calculations for days, hours, minutes and seconds
    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";

    // If the count down is over, write some text 
    if (distance < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "Welcome to Conference";
    }
  }, 1000);
</script>

<body>
  <!-- END nav -->
  <div class="hero-wrap" style="background-color:black;">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-start"
        data-scrollax-parent="true">
        <div class="col-md-9 ftco-animate" data-scrollax=" properties: { translateY: '70%' }">
          <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">
            <strong><br></strong></h1>
          <p data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">Fest starts in</p>
          <div>
            <h1 class="mb-4" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }"><strong
                id="demo"><br></strong></h1>

          </div>

          <div class="browse d-md-flex col-md-12">
            <div class="row">
              <?php
              
              ?>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section services-section bg-light">
    <div class="container">
      <div class="row d-flex">
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon"><span class="flaticon-guarantee"></span></div>
            </div>
            <div class="media-body p-2 mt-2">
              <h3 class="heading mb-3">Best Price Guarantee</h3>
              <p>A small river named Duden flows by their place and supplies.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon"><span class="flaticon-like"></span></div>
            </div>
            <div class="media-body p-2 mt-2">
              <h3 class="heading mb-3">Travellers Love Us</h3>
              <p>A small river named Duden flows by their place and supplies.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon"><span class="flaticon-detective"></span></div>
            </div>
            <div class="media-body p-2 mt-2">
              <h3 class="heading mb-3">Best Travel Agent</h3>
              <p>A small river named Duden flows by their place and supplies.</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 d-flex align-self-stretch ftco-animate">
          <div class="media block-6 services d-block text-center">
            <div class="d-flex justify-content-center">
              <div class="icon"><span class="flaticon-support"></span></div>
            </div>
            <div class="media-body p-2 mt-2">
              <h3 class="heading mb-3">Our Dedicated Support</h3>
              <p>A small river named Duden flows by their place and supplies.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
