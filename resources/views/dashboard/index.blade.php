@extends('layout/layout')
<script src="{{asset('style/js/homepage.js')}}"></script>
<link rel="stylesheet" href="{{asset('style/css/homepage.css')}}">
@section('content')
    <header>
        <section class="header" id="home">
                <div class="text-box">
                    <h1>Where Supply Chain Connects</h1>
                    <p>YCH Indonesia has been contributing to the supply chain development of Southeast Asia’s largest economy since 2003.
                    </p>
                    <a href="#about" class="hero-btn">Visit Us to Know More</a>
                </div>
        </section>
    </header>
    <!-- ABOUT -->
    <section class="about" id="about">
        <h1>About Us</h1>
        <p>YCH is Singapore’s largest home-grown supply chain solutions company and leading regional supply chain management
            partner to many of the world’s leading brands across Asia Pacific.</p>

        <div class="row">
            <div class="about-col">
                <h3>Our Vision</h3>
                <p>To build the Logistics Superhighway™ in a borderless world – integrating physical, information and financial flows in
                    the Supply Chain.</p>
            </div>
            <div class="about-col">
                <h3>Our Mission</h3>
                <p>To be the leading supply chain solutions partner of choice, leveraging on our network and depth across the Asia
                    Pacific.</p>
            </div>
            <div class="about-col">
                <h3>Our Values</h3>
                <p>The Chinese character – 升 (Sheng), which means to RISE above, is central to the values YCH is founded on.</p>
            </div>
        </div>
    </section>

    <!-- CONTACT -->
    <section class="contact" id="contact">
        <h1>Have Questions or Need Support? Get in Touch and We'll Get Back to You Soon!</h1>
        <a href="#contact-us" class="hero-btn">CONTACT US</a>
    </section>

    <!-- CONTACT CONTENT -->
    <section class="location">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3959.994032095999!2d110.35596457454223!3d-7.009983868663023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708af26686fd67%3A0xdbb1909416cc0e95!2sPT%20YCH%20Indonesia%20Semarang!5e0!3m2!1sen!2sid!4v1722443678886!5m2!1sen!2sid"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <section class="contact-us" id="contact-us">
        <div class="row">
            <div class="contact-col">
                <div>
                    <i class="fa-solid fa-house"></i>
                    <span>
                        <h5>Kawasan Industri Candi Block XI-A</h5>
                        <p>Jl. Gatot Subroto, Bambankerep, Semarang 50211, Central Java, Indonesia</p>
                    </span>
                </div>
                <div>
                    <i class="fa-solid fa-phone"></i>
                    <span>
                        <h5>Main Tel: (+62 21) 883 0828 <br>
                            Main Fax: (+62 21) 883 0809</h5>
                    </span>
                </div>
                <div>
                    <i class="fa-solid fa-envelope"></i>
                    <span>
                        <h5>indonesia@ych.com</h5>
                        <p>Email us your query</p>
                    </span>
                </div>
            </div>
            <div class="contact-col">
                <form action="">
                    <input type="text" placeholder="Enter your name" required>
                    <input type="email" placeholder="Enter email address" required>
                    <input type="text" placeholder="Enter your subject" required>
                    <textarea rows="8" placeholder="Message" required></textarea>
                    <button type="submit" class="hero-btn red-btn" > Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <section class="footer">
        <h4>Our Social Media</h4>
        <p>Stay Connected – Follow Us on Social Media!</p>
        <div class="icons">
            <a href="https://www.facebook.com/YCHGrp/" target="_blank"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://x.com/YCH_Group?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank"><i class="fa-brands fa-twitter"></i></a>
            <a href="https://www.youtube.com/channel/UC2HaB7wre_QUm1xaf0UXllQ" target="_blank"><i class="fa-brands fa-youtube"></i></a>
        </div>
    </section>
    <p>&copy; 2024 YCH Group. All Rights Reserved.</p>

@endsection
