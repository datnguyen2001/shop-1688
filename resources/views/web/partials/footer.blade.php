<footer class="wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item">
                    <h3 class="title-wd">{{@$system->company_name}}</h3>
                    <div class="nav-item">
                        <ul>
                            <li><img src="{{asset('assets/images/i1.png')}}" alt="address">Địa chỉ: {{@$system->address}}
                            </li>
                            <li><img src="{{asset('assets/images/i2.png')}}" alt="sđt">Hotline: {{@$system->phone}}</li>
                            <br>
                            <li><img src="{{asset('assets/images/i3.png')}}">Email:
                                {{@$system->email}}
                            </li>
                            <br>
                            <li><img src="{{asset('assets/images/i4.png')}}" alt="web">Website:
                                {{@$system->website}}
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item footer-facebook">
                    <h3 class="title-wd">Facebook</h3>
                    <div class="nav-item">
                        <iframe
                            src="https://www.facebook.com/plugins/page.php?href=https://www.facebook.com/thamdudumuc90&tabs=timeline&width=363&height=190&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=343876996017079"
                            width="363" height="190" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                            allowTransparency="true" allow="encrypted-media"></iframe>

                    </div>
                    <div class="social-footer">
                        <ul>
                            <li class="lk">Liên kết mạng xã hội:</li>
                            <li><a href="{{@$system->facebook}}" target="_blank"><i
                                        class="fab fa-facebook-f"></i></a></li>
                            <li><a href="{{@$system->twitter}}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="{{route('home')}}" target="_blank"><i class="fab fa-google"></i></a></li>
                            <li><a href="{{@$system->youtube}}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4 col-xs-12">
                <div class="item">
                    <h3 class="title-wd">ĐĂNG KÝ NHẬN BẢN TIN</h3>
                    <div class="box_formft">
                        <form action="{{route('save-receive-newsletter')}}" method="post" id="sform">
                            @csrf
                            <div class="left">
                                <input type="text" id="fullname" name="fullname" required placeholder="Họ và tên">
                                <input type="text" id="email" name="email" required placeholder="Email">
                            </div>
                            <div class="right">
                                <button type="submit"><img src="{{asset('assets/images/bg_button.png')}}"
                                                           alt="Submit"></button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>

        </div>
    </div>
</footer>

<div class="backtotop"><img src="{{asset('assets/images/btn-top.png')}}" alt="" style="width: 40px;"></div>

<div class="fix-phone">
    <div class="bbh">
        <div class="phone">
            <a href="{{@$system->facebook}}" title="Chat Facebook" target="_blank">
                <div class="fb-box"><img class=" " src="{{asset('assets/images/facebook.png')}}"
                                         alt="Mew Coffee"></div>
            </a>
        </div>
        <div class="phone">
            <a href="https://zalo.me/{{@$system->zalo}}" title="Chat Zalo" target="_blank">
                <div class="zalo-box"><img class="" src="{{asset('assets/images/zalotu.png')}}"
                                           alt="Mew Coffee"></div>
            </a></div>
        <div class="phone">
            <a href="tel:{{@$system->phone}}" title="Gọi ngay">
                <div class="phone-box"><img class=" " src="{{asset('assets/images/telephone.png')}}"
                                            alt="Mew Coffee"> <strong class="oi">{{@$system->phone}}</strong></div>
            </a>
        </div>
    </div>
</div>

<div class="product-action-bottom visible-xs">
    <div class="add-cart-bottom">
        <a href="{{@$system->facebook}}">
            <img src="https://cdn.autoads.asia/content/images/widget_m_icon_facebook.svg" alt="">
        </a>
        <span>Messenger</span>
    </div>
    <div class="add-cart-bottom">
        <a href="https://zalo.me/{{@$system->phone}}">
            <img src="https://cdn.autoads.asia/content/images/widget_m_icon_zalo.svg" alt="">
        </a>
        <span>Zalo</span>
    </div>
    <div class="add-cart-bottom">
        <a href="tel:{{@$system->phone}}">
            <img src="https://cdn.autoads.asia/content/images/widget_m_icon_click_to_call.svg" alt="">
        </a>
        <span>Gọi ngay</span>
    </div>
    <div class="add-cart-bottom">
        <a href="{{route('contact')}}">
            <img src="https://cdn.autoads.asia/content/images/widget_m_icon_contact_form.svg" alt="">
        </a>
        <span>Liên hệ</span>
    </div>
</div>
