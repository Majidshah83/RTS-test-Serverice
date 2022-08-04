<div class="container-fluid">
    <div class="row mt-5">
        <div class="boxes">
            <div class="col-lg-4 col-md-12 col-sm-12 p-0">
                <div class="emergency">
                    <div class="box-overlay-form">
                        <h4 class="heading-small">Quick help</h4>
                        <h2 class="section-heading">Send us a Message</h2>
                        <form method="post" role="form" class="php-email-form" id="contact_us_frm">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger" id="error_div" style="display:none;">
                                        <ul id="error_ul"></ul>
                                    </div>
                                    <div class="alert alert-success" id="success_div" style="display:none;">
                                        <ul id="success_ul"></ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 col-sm-12">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" kl_vkbd_parsed="true"> </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <input type="email" class="form-control" name="email_address" id="email_address" placeholder="Your Email" kl_vkbd_parsed="true"> </div>
                            </div>
                            <div class="form-group ">
                                <input type="text" class="form-control" name="contact_no" id="contact_no" placeholder="Your Contact Number" kl_vkbd_parsed="true"> </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                            </div>
                            <div class="my-3">
                                <div class="error-message" style="display: none;"></div>
                                <div class="sent-message" style="display: none;">Your message has been sent. Thank you!</div>
                            </div>
                            <div class="form-group mt-3">
                                <!-- Google Captcha V2 Script -->
                                <script src="../www.google.com/recaptcha/api.js" async defer></script>
                                <!-- Google Captcha V2 Div -->
                                <div class="g-recaptcha" data-sitekey="6LfAOOoaAAAAAGk9tjszOQVJdyEszM3zX_P9PbyS"></div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="button" id="contact_us_submit_btn" class="btn btn-primary btn-send"> Send Message </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 p-0">
                <div class="opening-hours">
                    <div class="box-overlay-hours">
                        <h4 class="heading-small text-white">Check schedule</h4>
                        <h2 class="section-heading text-white">Opening Hours</h2>
                        <div class="schedule-block-wrapper">
                            <ul class="schedule-block">
                                <li> Monday <span class="schedule-time">
                                   9 AM - 6 PM
                                </span> </li>
                                <li>Tuesday <span class="schedule-time">
                                   9 AM - 6 PM
                                </span> </li>
                                <li>Wednesday <span class="schedule-time">
                                  9 AM - 6 PM
                                </span> </li>
                                <li>Thursday <span class="schedule-time">
                                  9 AM - 6 PM
                                </span> </li>
                                <li>Friday <span class="schedule-time">
                                  9 AM - 6 PM
                                </span> </li>
                                <li>Saturday <span class="schedule-time">
                                 9 AM - 6 PM
                                </span> </li>
                                <li>Sunday <span class="schedule-time">
                                 9 AM - 6 PM
                                </span> </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 p-0">
                <div class="special-services">
                    <div class="box-overlay-black">
                        <h4 class="heading-small text-white">Quick help</h4>
                        <h2 class="section-heading text-white">Get Started</h2>
                        <p>
                            Request for quotation of hiring RTS services for Recruitment, Research, Admission Tests, Training and Development, Enterprise software solution for data management.
                        </p>
                        <h2 class="section-heading text-white">Whatsapp Numbers:</h2>
                        <ul class="emergency-num">
                            <li>
                                <span class=" font-weight-bold">01514208794</span>
                            </li>
                        </ul>
                        <a href="{{route('contact-us')}}" class="mt-5 btn btn-outline-secondary">Contact Us Now</a> </div>
                </div>
            </div>
        </div>
    </div>
</div>
