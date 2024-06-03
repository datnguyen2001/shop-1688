<div class="col-md-3 col-sm-3 col-xs-12">
    <!-- block category -->
    <div class="sidebar">
        <aside class="item-sb1" style="padding-bottom: 30px">
            <div class="accordion-container">
                <div class="set">
                    <a class="click-parent1" href=""> Tìm kiến nâng cao</a>
                </div>
                <div class="clearfix" style="height: 10px"></div>
                <form method="get" action="{{route('search')}}">
                    <div class="form-group">
                        <input type="text" placeholder="Tên sản phẩm, mã sản phẩm" name="key_search" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="category_id">
                            <option value="">Danh mục sản phẩm</option>
                            @if(isset($category))
                                @foreach($category as $cate)
                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                    @if(isset($cate->cate_child))
                                        @foreach($cate->cate_child as $item)
                                            <option value="{{$item->id}}">|----{{$item->name}}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>

                    </div>
                    <div class="form-group">
                        <datalist id="ice-cream-flavors">
                        </datalist>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </aside>
    </div>
    <!-- block category -->
    <div class="sidebar">
        <aside class="item-sb1">
            <div class="accordion-container">
                @if(isset($category))
                    @foreach($category as $cate)
                        <div class="set">
                            <a class="click-parent" href="{{route('category',$cate->slug)}}">{{$cate->name}}</a>
                            <div class="content">
                                @if(isset($cate->cate_child))
                                    <ul class="submenu">
                                        @foreach($cate->cate_child as $item)
                                            <li class="ul222" style="position: relative">
                                                <a href="{{route('category',$item->slug)}}"><i
                                                        class="fas fa-angle-right"></i>{{$item->name}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </aside>

        @if(isset($support) && count($support) >0)
            <aside class="item-sb">
                <div class="support-sidebar">
                    <div class="support item1">
                        <div class="images">
                            <img src="{{asset('assets/images/suport.png')}}" alt="">
                        </div>

                        <div class="problem">
                            @foreach($support as $key => $supports)
                                <div class="item">
                                    <h3 class="title">Nhân viên {{$supports->name}}</h3>
                                    <h4>Hỗ trợ {{$key+1}}: <span>{{$supports->phone}}</span></h4>
                                    <ul>
                                        <li>
                                            <a href="{{$supports->facebook}}" target="_blank"><img
                                                    src="{{asset('assets/images/icon4.png')}}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="https://zalo.me/{{$supports->phone}}" target="_blank"><img
                                                    src="{{asset('assets/images/icon5.png')}}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </aside>
        @endif

    </div>

</div>
