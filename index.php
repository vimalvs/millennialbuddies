<?php
include 'header.php'
?>
  <!--==========================
    Hero Section
  ============================-->
  <section id="hero" class="wow fadeIn">
    <div class="hero-container">
      <img src="img/hero-img.png" alt="Hero Imgs">
      <div class="btns">
        <a href="#"><i class="fa fa-apple fa-3x"></i> Be you, We see a star in you to beat the odds.</a>
      </div>
    </div>
  </section><!-- #hero -->


  <!--==========================
    About Us Section
  ============================-->
  <section id="about-us" class="about-us padd-section wow fadeInUp">
    <div class="container">
      <div class="row justify-content-center">

        <div class="col-md-5 col-lg-3">
          <img src="img/about-img.png" alt="About">
        </div>

        <div class="col-md-7 col-lg-5">
          <div class="about-content">

            <h2><span>Millennial</span>Buddies </h2>
            <p>
              Millennial Buddies is a software platform for young secondary school children to develop competencies such as Problem Solving, Decision Making, Team Collaboration and Time Management through e-learning and gamification.
            </p>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!--==========================
    Features Section
  ============================-->

  <section id="vision" class="padd-section text-center wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">
        <h2>Vision</h2>
        <p class="separator">The company strives to create a platform for a competency based learning experience in a fun and interactive way that is vital in this era of digitalisation and thereby provide a value based education system to enhance the skills in young children.</p>
      </div>
    </div>

  <!--==========================
    Blog Section
  ============================-->
  <section id="product" class="padd-section wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">

        <h2>Product</h2>
        <p class="separator">
            The platform is visualised as a gaming platform with various basic, intermediate and
            complex levels of puzzles and group activities to ensure that children can continue training themselves in a fun-filled platform. The platform will be hosted on a website
        </p>

      </div>
    </div>
  </section>

  <!--==========================
    Newsletter Section
  ============================-->
  <section id="newsletter" class="newsletter text-center wow fadeInUp">
    <div class="overlay padd-section">
      <div class="container">

        <div class="row justify-content-center">
          <div class="col-md-9 col-lg-6">
            <form class="form-inline" method="POST" action="#">

              <input type="email" class="form-control subscribe-email" placeholder="Email Adress" name="email">
              <button type="button" class="btn btn-default btn-subscribe"><i class="fa fa-location-arrow"></i>Subscribe</button>

            </form>

          </div>
        </div>

          <ul class="list-unstyled">
            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
          </ul>


      </div>
    </div>
  </section>

  <!--==========================
    Contact Section
  ============================-->
  <section id="contact" class="padd-section wow fadeInUp">

    <div class="container">
      <div class="section-title text-center">
        <h2>Let's Get In Touch!</h2>
        <p class="separator">Ready to start your next project with us? That's great! Give us a call or send us an email and we will get back to you as soon as possible!</p>
      </div>
    </div>

    <div class="container">
      <div class="row justify-content-center">

        <div class="col-lg-3 col-md-4">

          <div class="info">
            <div class="email">
              <i class="fa fa-envelope"></i>
              <p>feedback@millenialbuddies.com</p>
            </div>

            <div>
              <i class="fa fa-phone"></i>
              <p>+1 123-456-789</p>
            </div>
          </div>

          <div class="social-links">
            <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
            <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
            <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
            <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
            <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
          </div>

        </div>

        <div class="col-lg-5 col-md-8">
          <div class="form">
            <div id="sendmessage">Your message has been sent. Thank you!</div>
            <div id="errormessage"></div>
            <form action="" method="post" role="form" class="contactForm">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validation"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                <div class="validation"></div>
              </div>
              <div class="text-center"><button type="submit">Send Message</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section><!-- #contact -->

 <?php
 include 'footer.php';
 ?>