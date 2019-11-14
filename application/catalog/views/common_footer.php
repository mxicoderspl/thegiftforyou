<footer id="contact-us" style="margin-top: 230px;">
                                        <div class="container">
                                            <ul class="footer-menu-left float-left">
                                                <li><a href="<?php echo site_url('Home')?>">Home</a></li>
                                                <li><a href="<?php echo site_url('About')?>">About us</a></li>
                                                <!--<li><a href="#business">Business Plan</a></li>
                                                <li><a href="<?php echo base_url()?>#testmonials">Testmonials</a></li>-->
                                                <li><a class="nav-link" data-toggle="modal" href="" data-target="#contact">Contact Us</a></li>
                                            </ul>
                                            <ul class="footer-menu-left float-right">
                                                <li>
						<a title="Facebook" href="https://www.facebook.com"><i class="fab fa-facebook fa-2x"></i></a></li>
      						<li><a title="Twitter" href="https://www.twitter.com/"><i class="fab fa-twitter-square fa-2x"></i></a></li>
      						<li><a title="Linkedin" href="https://www.linkedin.com/"><i class="fab fa-linkedin fa-2x"></i></a></li>
                                            </ul>
                                        </div>
                                        <p>Design and Development by <a href="">Mxiocders Pvt LTD</a></p>
                                    </footer>

                                    <div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Contact Us</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <?php echo form_open('contact/send', array('id' => 'contactform', 'class' => '', 'role' => 'form')); ?>
                                                    <div class="modal-body all-form">
                                                        <div class="form-group">
                                                            <label for="">First Name</label>
                                                            <input type="text" class="form-control" id="fname" name="fname" aria-describedby="" placeholder="First Name">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Last Name</label>
                                                            <input type="text" class="form-control" id="lname" name="lname" aria-describedby="" placeholder="Last Name">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" aria-describedby="" placeholder="Your Email">

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Message</label>
                                                            <textarea type="text" class="form-control" id="message" name="message" placeholder="Your Message"></textarea>
                                                        </div>


                                                    </div>
                                               
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                   
                                                </div>
                                            <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $this->minify->js(array('jquery-1.11.1.min.js', 'jquery.validate.min.js','bootstrap.min.js', 'fontawesome-all.min.js', 'wow.min.js'));
                                    echo $this->minify->deploy_js();
                                    ?>
                                    <!--<script src="assetshome/js/jquery-1.11.1.min.js"></script> 
                                    <script src="assetshome/js/bootstrap.min.js"></script> 
                                    <script src="assetshome/js/fontawesome-all.min.js"></script> 
                                    <script src="assetshome/js/wow.min.js"></script> -->
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.js"></script> 
                                    <script type="text/javascript">
                                        // JavaScript Document

                                        $(window).load(function () {
                                            $('.bg-all').hide();
                                        });
                                        new WOW().init();
                                        // Set Equal Height 

                                        equalheight = function (container) {
                                            var currentTallest = 0,
                                                    currentRowStart = 0,
                                                    rowDivs = new Array(),
                                                    $el,
                                                    topPosition = 0;
                                            $(container).each(function () {

                                                $el = $(this);
                                                $($el).height('auto')
                                                topPostion = $el.position().top;
                                                if (currentRowStart != topPostion) {
                                                    for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                                                        rowDivs[currentDiv].height(currentTallest);
                                                    }
                                                    rowDivs.length = 0; // empty the array
                                                    currentRowStart = topPostion;
                                                    currentTallest = $el.height();
                                                    rowDivs.push($el);
                                                } else {
                                                    rowDivs.push($el);
                                                    currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                                                }
                                                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                                                    rowDivs[currentDiv].height(currentTallest);
                                                }
                                            });
                                        }

                                        $(window).load(function () {
                                            equalheight('#header .fix-all');
                                        });
                                        $(window).resize(function () {
                                            equalheight('#header .fix-all');
                                        });
                                        $(document).ready(function () {
                                            $('.slider').bxSlider({
                                                slideWidth: 165,
                                                minSlides: 1,
                                                moveSlides: 1,
                                                maxSlides: 6,
                                                slideMargin: 30,
                                                ticker: true,
                                                speed: 70000,
                                                tickerHover: true,
                                            });
                                        });
                                        $('.navbar-collapse a').click(function () {
                                            $(".navbar-collapse").collapse('hide');
                                        });
                                        var sections = $('section')
                                                , nav = $('nav')
                                                , nav_height = nav.outerHeight();
                                        $(window).on('scroll', function () {
                                            var cur_pos = $(this).scrollTop();
                                            sections.each(function () {
                                                var top = $(this).offset().top - nav_height,
                                                        bottom = top + $(this).outerHeight();
                                                if (cur_pos >= top && cur_pos <= bottom) {
                                                    nav.find('a').removeClass('active');
                                                    sections.removeClass('active');
                                                    $(this).addClass('active');
                                                    nav.find('a[href="#' + $(this).attr('id') + '"]').addClass('active');
                                                }
                                            });
                                        });
                                        $(document).ready(function () {

                                            if ($(window).width() <= 767)
                                            {
                                                nav.find('a').on('click', function () {
                                                    var $el = $(this)
                                                            , id = $el.attr('href');
                                                    $('html, body').animate({
                                                        scrollTop: $(id).offset().top - 95
                                                    }, 500);
                                                    return false;
                                                });
                                            }

                                        });
                                        $(document).ready(function () {

                                            if ($(window).width() >= 768)
                                            {
                                                nav.find('a').on('click', function () {
                                                    var $el = $(this)
                                                            , id = $el.attr('href');
                                                    $('html, body').animate({
                                                        scrollTop: $(id).offset().top - 25
                                                    }, 500);
                                                    return false;
                                                });
                                            }

                                        });
                                    </script> 
                                    <script>
                                        $(document).ready(function () {
                                            $('#contactform').validate({

                                                rules: {

                                                    fname: {
                                                        required: true
                                                    },
                                                    lname: {
                                                        required: true
                                                    },
                                                    email: {
                                                        required: true
                                                    },

                                                    message: {
                                                        required: true
                                                    },
                                                },
                                                messages: {

                                                    fname: {
                                                        required: "Firstname is required"
                                                    },
                                                    lname: {
                                                        required: "Lastname is required"
                                                    },
                                                    email: {
                                                        required: "Email is required"
                                                    },
                                                    message: {
                                                        required: "Message is required"
                                                    },
                                                },
                                                errorPlacement: function (error, element) {

                                                    error.insertAfter(element);

                                                }
                                            });
                                        });
//                  
                                    </script>
                                    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries --> 
                                    <!-- WARNING: Respond.js doesn't work if you view the page via file:// --> 
                                    <!--[if lt IE 9]>
                                          <script src="js/html5shiv.js"></script>
                                          <script src="js/respond.min.js"></script>
                                        <![endif]--> 
                                    <!-- End Bootstrap JS -->
                                </body>
                                </html>

