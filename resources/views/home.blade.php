@extends('layouts.app')
@section('content')
    <php?
        @foreach ($websiteSettings as $option)
        @if ($option['option_name'] == 'restaurant_name')
            {{ $restaurantName = $option['option_value'] }}
        @elseif($option['option_name'] == 'restaurant_email')
            {{ $restaurantEmail = $option['option_value'] }}
        @elseif($option['option_name'] == 'restaurant_phonenumber')
            {{ $restaurantPhonenumber = $option['option_value'] }}
        @elseif($option['option_name'] == 'restaurant_address')
            {{ $restaurantAddress = $option['option_value'] }}
        @endif @endforeach
        ?>


        <x-header />
        <x-navbar />
            <section class="home-section" id="home">
                <div class="container">
                    <div class="row" style="flex-wrap: nowrap;">
                        <div class="col-md-6 home-left-section">
                            <div style="padding: 100px 0px; color: white;">
                                <h1>
                                    VINCENT PIZZA.
                                </h1>
                                <h2>
                                    MAKING PEOPLE HAPPY
                                </h2>
                                <hr>
                                <p>
                                    Italian Pizza With Cherry Tomatoes and Green Basil
                                </p>
                                <div style="display: flex;">
                                    <a href="order_food" target="_blank" class="bttn_style_1"
                                        style="margin-right: 10px; display: flex;justify-content: center;align-items: center;">
                                        Order Now
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                    <a href="#menus" class="bttn_style_2"
                                        style="display: flex;justify-content: center;align-items: center;">
                                        VIEW MENU
                                        <i class="fas fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- OUR QUALITIES SECTION -->

            <section class="our_qualities" style="padding:100px 0px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="our_qualities_column">
                                <img src="{{ asset('images/quality_food_img.png') }}">
                                <div class="caption">
                                    <h3>
                                        Quality Foods
                                    </h3>
                                    <p>
                                        Sit amet, consectetur adipiscing elit quisque eget maximus velit,
                                        non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="our_qualities_column">
                                <img src="{{ asset('images/fast_delivery_img.png') }}">
                                <div class="caption">
                                    <h3>
                                        Quality Foods
                                    </h3>
                                    <p>
                                        Sit amet, consectetur adipiscing elit quisque eget maximus velit,
                                        non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="our_qualities_column">
                                <img src="{{ asset('images/original_taste_img.png') }}">
                                <div class="caption">
                                    <h3>
                                        Quality Foods
                                    </h3>
                                    <p>
                                        Sit amet, consectetur adipiscing elit quisque eget maximus velit,
                                        non eleifend libero curabitur dapibus mauris sed leo cursus aliquetcras suscipit.
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </section>

            <!-- OUR MENUS SECTION -->

            <section class="our_menus" id="menus">
                <div class="container">
                    <h2 style="text-align: center;margin-bottom: 30px">DISCOVER OUR MENUS</h2>
                    <div class="menus_tabs">
                        <div class="menus_tabs_picker">
                            <ul style="text-align: center;margin-bottom: 70px">
                                @php
                                    $menuCategoriesCount = 0;
                                @endphp
                                @foreach ($menuCategories as $menuCategory)
                                    @if ($menuCategoriesCount == 0)
                                        <li class="menu_category_name tab_category_links active_category"
                                            onclick="showCategoryMenus(event, '{{ str_replace(' ', '', $menuCategory['category_name']) }}')">
                                            {{ $menuCategory['category_name'] }}
                                        </li>
                                    @else
                                        <li class="menu_category_name tab_category_links"
                                            onclick="showCategoryMenus(event, '{{ str_replace(' ', '', $menuCategory['category_name']) }}')">
                                            {{ $menuCategory['category_name'] }}
                                        </li>
                                    @endif
                                    @php
                                        $menuCategoriesCount++;
                                    @endphp
                                @endforeach
                            </ul>
                        </div>

                        <div class="menus_tab">
                            @php
                                $i = 0;
                            @endphp

                            @foreach ($menuCategories as $menuCategory)
                                @if ($i == 0)
                                    <div class="menu_item  tab_category_content"
                                        id="{{ str_replace(' ', '', $menuCategory['category_name']) }}"
                                        style="display:block">
                                        @php
                                            $rows_menus = App\Models\Menu::where(
                                                'category_id',
                                                $menuCategory['category_id'],
                                            )->get();
                                        @endphp

                                        @if ($rows_menus->isEmpty())
                                            <div style='margin:auto'>No Available Menus for this category!</div>
                                        @endif

                                        <div class='row'>
                                            @foreach ($rows_menus as $menu)
                                                <div class="col-md-4 col-lg-3 menu-column">
                                                    <div class="thumbnail" style="cursor:pointer">
                                                        @php
                                                            $source = asset('anotherImages/' . $menu['menu_image']);
                                                        @endphp

                                                        <div class="menu-image">
                                                            <div class="image-preview">
                                                                <div style="background-image: url('{{ $source }}');">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="caption">
                                                            <h5>{{ $menu['menu_name'] }}</h5>
                                                            <p>{{ $menu['menu_description'] }}</p>
                                                            <span class="menu_price">${{ $menu['menu_price'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="menus_categories  tab_category_content"
                                        id="{{ str_replace(' ', '', $menuCategory['category_name']) }}">
                                        @php
                                            $rows_menus = App\Models\Menu::where(
                                                'category_id',
                                                $menuCategory['category_id'],
                                            )->get();
                                        @endphp

                                        @if ($rows_menus->isEmpty())
                                            <div class='no_menus_div'>No Available Menus for this category!</div>
                                        @endif

                                        <div class='row'>
                                            @foreach ($rows_menus as $menu)
                                                <div class="col-md-4 col-lg-3 menu-column">
                                                    <div class="thumbnail" style="cursor:pointer">
                                                        @php
                                                            $source = asset('anotherImages/' . $menu['menu_image']);
                                                        @endphp

                                                        <div class="menu-image">
                                                            <div class="image-preview">
                                                                <div style="background-image: url('{{ $source }}');">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="caption">
                                                            <h5>{{ $menu['menu_name'] }}</h5>
                                                            <p>{{ $menu['menu_description'] }}</p>
                                                            <span class="menu_price">${{ $menu['menu_price'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </div>
                    </div>
                </div>
        </div>
        </section>

        <!-- IMAGE GALLERY -->

        <section class="image-gallery" id="gallery">
            <div class="container">
                <h2 style="text-align: center;margin-bottom: 30px">IMAGE GALLERY</h2>
                {{-- replace with imageGallery --}}
                <div class='row'>
                    @foreach ($imageGalleries as $image)
                        <div class = 'col-md-4 col-lg-3' style = 'padding:15px'>
                            @php
                                $source = asset('anotherImages/' . $image['image']);
                            @endphp
                            <div
                                style="background-image: url('{{ $source }}'); !important;background-repeat: no-repeat;background-position: 50% 50%;background-size: cover;background-clip: border-box;box-sizing: border-box;overflow: hidden;height: 230px;">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CONTACT US SECTION -->

        <section class="contact-section" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 sm-padding">
                        <div class="contact-info">
                            <h2>
                                Get in touch with us &
                                <br>send us message today!
                            </h2>
                            <p>
                                Saasbiz is a different kind of architecture practice. Founded by LoganCee in 1991, we’re an
                                employee-owned firm pursuing a democratic design process that values everyone’s input.
                            </p>
                            <h3>
                                {{ $restaurantName }}
                            </h3>
                            <h4>
                                <span>Email:</span>
                                {{ $restaurantEmail }}
                                <br>
                                <span>Phone:</span>
                                {{ $restaurantPhonenumber }}
                            </h4>
                        </div>
                    </div>
                    <div class="col-lg-6 sm-padding">
                        <div class="contact-form">
                            <div id="contact_ajax_form" class="contactForm">
                                <form method="POST" action="{{ url('contact') }}">
                                    @csrf
                                    <div class="form-group colum-row row">
                                        <div class="col-sm-6">
                                            <input type="text" id="contact_name" name="name" class="form-control"
                                                placeholder="Name">
                                            @error('name')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" id="contact_email" name="email" class="form-control"
                                                placeholder="Email">
                                            @error('email')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <input type="text" id="contact_subject" name="subject"
                                                class="form-control" placeholder="Subject">
                                            @error('subject')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <textarea id="contact_message" name="message" cols="30" rows="5" class="form-control message"
                                                placeholder="Message"></textarea>
                                            @error('message')
                                                <div class="invalid-feedback" style="display: block">{{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <button type="submit" id="contact_send" class="bttn_style_2">Send
                                                Message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- OUR QUALITIES SECTION -->

        <section class="our_qualities_v2">
            <div class="container">
                <div class="row">
                    <div class="col-md-4" style="padding: 10px;">
                        <div class="quality quality_1">
                            <div class="text_inside_quality">
                                <h5>Quality Foods</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 10px;">
                        <div class="quality quality_2">
                            <div class="text_inside_quality">
                                <h5>Fastest Delivery</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding: 10px;">
                        <div class="quality quality_3">
                            <div class="text_inside_quality">
                                <h5>Original Recipes</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- WIDGET SECTION / FOOTER -->

        <section class="widget_section" style="background-color: #222227;padding: 100px 0;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="footer_widget">
                            <img src="{{ asset('images/restaurant-logo.png') }}" alt="Restaurant Logo"
                                style="width: 150px;margin-bottom: 20px;">
                            <p>
                                Our Restaurnt is one of the bests, provide tasty Menus and Dishes. You can reserve a table
                                or Order food.
                            </p>
                            <ul class="widget_social">
                                <li><a href="#" data-toggle="tooltip" title="Facebook"><i
                                            class="fab fa-facebook-f fa-2x"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Twitter"><i
                                            class="fab fa-twitter fa-2x"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Instagram"><i
                                            class="fab fa-instagram fa-2x"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="LinkedIn"><i
                                            class="fab fa-linkedin fa-2x"></i></a></li>
                                <li><a href="#" data-toggle="tooltip" title="Google+"><i
                                            class="fab fa-google-plus-g fa-2x"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer_widget">
                            <h3>Headquarters</h3>
                            <p>
                                {{ $restaurantAddress }}
                            </p>
                            <p>
                                {{ $restaurantEmail }}
                                <br>
                                {{ $restaurantPhonenumber }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer_widget">
                            <h3>
                                Opening Hours
                            </h3>
                            <ul class="opening_time">
                                <li>Monday - Friday 11:30am - 2:008pm</li>
                                <li>Monday - Friday 11:30am - 2:008pm</li>
                                <li>Monday - Friday 11:30am - 2:008pm</li>
                                <li>Monday - Friday 11:30am - 2:008pm</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="footer_widget">
                            <h3>Subscribe to our contents</h3>
                            <div class="subscribe_form">
                                <form action="#" class="subscribe_form" novalidate="true">
                                    <input type="email" name="EMAIL" id="subs-email" class="form_input"
                                        placeholder="Email Address...">
                                    <button type="submit" class="submit">SUBSCRIBE</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FOOTER BOTTOM  -->

        <x-footer />
        </div>
    @endsection


    {{-- <script type="text/javascript">
        $(document).ready(function() {
            $('#contact_send').click(function() {
                var contact_name = $('#contact_name').val();
                var contact_email = $('#contact_email').val();
                var contact_subject = $('#contact_subject').val();
                var contact_message = $('#contact_message').val();

                var flag = 0;

                if ($.trim(contact_name) == "") {
                    $('#invalid-name').text('This is a required field!');
                    flag = 1;
                } else {
                    if (contact_name.length < 5) {
                        $('#invalid-name').text('Length is less than 5 letters!');
                        flag = 1;
                    }
                }

                if (!ValidateEmail(contact_email)) {
                    $('#invalid-email').text('Invalid e-mail!');
                    flag = 1;
                }

                if ($.trim(contact_subject) == "") {
                    $('#invalid-subject').text('This is a required field!');
                    flag = 1;
                }

                if ($.trim(contact_message) == "") {
                    $('#invalid-message').text('This is a required field!');
                    flag = 1;
                }

                if (flag == 0) {
                    $('#sending_load').show();

                    $.ajax({
                        url: "Includes/php-files-ajax/contact.php",
                        type: "POST",
                        data: {
                            contact_name: contact_name,
                            contact_email: contact_email,
                            contact_subject: contact_subject,
                            contact_message: contact_message
                        },
                        success: function(data) {
                            $('#contact_status_message').html(data);
                        },
                        beforeSend: function() {
                            $('#sending_load').show();
                        },
                        complete: function() {
                            $('#sending_load').hide();
                        },
                        error: function(xhr, status, error) {
                            alert("Internal ERROR has occured, please, try later!");
                        }
                    });
                }

            });
        });
    </script> --}}
