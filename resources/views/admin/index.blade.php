@extends('admin.layout.index')
<style>
    .display-date {
        text-align: center;
        margin-bottom: 10px;
        font-size: 1.6rem;
        font-weight: 600;
    }
    .display-time {
        display: flex;
        font-size: 5rem;
        font-weight: bold;
        border: 2px solid #ffd868;
        padding: 10px 20px;
        border-radius: 5px;
        transition: ease-in-out 0.1s;
        transition-property: background, box-shadow, color;
        /*-webkit-box-reflect: below 2px*/
        /*linear-gradient(transparent, rgba(255, 255, 255, 0.05));*/
    }
    .display-time:hover {
        background: #ffd868;
        box-shadow: 0 0 30px#ffd868;
        color: #272727;
        cursor: pointer;
    }
    .main{
        height: calc(100% - 120px);
    }
    .box-das-1{
        width: 24%;
        background-color: #2878e9;
        border-radius: 4px;
        color: white;
        margin-bottom: 10px;
    }
    .box-das-2{
        width: 24%;
        background-color: #03e950;
        border-radius: 4px;
        color: white;
        margin-bottom: 10px;
    }
    .box-das-3{
        width: 24%;
        background-color: #e9a428;
        border-radius: 4px;
        color: white;
        margin-bottom: 10px;
    }
    .box-das-4{
        width: 24%;
        background-color: #e95e14;
        border-radius: 4px;
        color: white;
        margin-bottom: 10px;
    }
    .line-more-info{
        display: inline-block;
        width: 100%;
        text-align: center;
        color: white;
        background-color: rgba(215, 215, 215, 0.7);
        padding: 5px;
    }
    .line-more-info:hover{
        color: white;
    }
    @media (max-width: 992px) {
        .box-das-1,.box-das-2,.box-das-3,.box-das-4{
            width: 32.5%;
        }

    }
    @media (max-width: 600px) {
        .box-das-1,.box-das-2,.box-das-3,.box-das-4{
            width: 49%;
        }

    }
</style>
@section('main')
    <main id="main" class="main d-flex flex-column">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="box-das-1 ">
                <div class="d-flex justify-content-between align-items-center" style="padding: 15px">
                    <div>
                        <p style="font-size: 32px;margin-bottom: 10px">{{$count_order}}</p>
                        <p>Tổng số đơn hàng</p>
                    </div>
                    <i class="fa-solid fa-bag-shopping" style="font-size: 48px"></i>
                </div>
                <a href="{{url('admin/order/index/all')}}" class="line-more-info">
                    More info <i class="fa-solid fa-caret-right"></i>
                </a>
            </div>
            <div class="box-das-2 ">
                <div class="d-flex justify-content-between align-items-center" style="padding: 15px">
                    <div>
                        <p style="font-size: 32px;margin-bottom: 10px">{{$count_product}}</p>
                        <p>Tổng số sản phẩm</p>
                    </div>
                    <i class="fa-solid fa-chart-simple" style="font-size: 48px"></i>
                </div>
                <a href="{{url('admin/product')}}" class="line-more-info">
                    More info <i class="fa-solid fa-caret-right"></i>
                </a>
            </div>
            <div class="box-das-3 ">
                <div class="d-flex justify-content-between align-items-center" style="padding: 15px">
                    <div>
                        <p style="font-size: 32px;margin-bottom: 10px">{{$count_user}}</p>
                        <p>Tổng số lượt truy cập</p>
                    </div>
                    <i class="fa-solid fa-user-plus" style="font-size: 48px"></i>
                </div>
                <a href="{{url('admin/user')}}" class="line-more-info">
                    More info <i class="fa-solid fa-caret-right"></i>
                </a>
            </div>
            <div class="box-das-4 ">
                <div class="d-flex justify-content-between align-items-center" style="padding: 15px">
                    <div>
                        <p style="font-size: 32px;margin-bottom: 10px">{{$count_contact}}</p>
                        <p>Tổng số liên hệ</p>
                    </div>
                    <i class="fa-solid fa-folder-closed" style="font-size: 48px"></i>
                </div>
                <a href="{{url('admin/contact')}}" class="line-more-info">
                    More info <i class="fa-solid fa-caret-right"></i>
                </a>
            </div>
        </div>
        <div style="width: 50%;margin: 0 auto;margin-top: 100px">
            <div class="display-date">
                <span id="day">day</span>,
                <span>Ngày</span>
                <span id="daynum">00</span>
                <span id="month">month</span>
                <span id="year">0000</span>
            </div>
            <div class="display-time justify-content-center"></div>
        </div>
    </main>
@endsection
@section('script')
<script>
    const displayTime = document.querySelector(".display-time");
    function showTime() {
        let time = new Date();
        displayTime.innerText = time.toLocaleTimeString("en-US", { hour12: false });
        setTimeout(showTime, 1000);
    }
    showTime();
    function updateDate() {
        let today = new Date();
        let dayName = today.getDay(),
            dayNum = today.getDate(),
            month = today.getMonth(),
            year = today.getFullYear();
        const months = [
            "Tháng 1",
            "Tháng 2",
            "Tháng 3",
            "Tháng 4",
            "Tháng 5",
            "Tháng 6",
            "Tháng 7",
            "Tháng 8",
            "Tháng 9",
            "Tháng 10",
            "Tháng 11",
            "Tháng 12",
        ];
        const dayWeek = [
            "Chủ nhật",
            "Thứ 2",
            "Thứ 3",
            "Thứ 4",
            "Thứ 5",
            "Thứ 6",
            "Thứ 7",
        ];
        const IDCollection = ["day", "daynum", "month", "year"];
        const val = [dayWeek[dayName], dayNum, months[month], year];
        for (let i = 0; i < IDCollection.length; i++) {
            document.getElementById(IDCollection[i]).firstChild.nodeValue = val[i];
        }
    }

    updateDate();
</script>
@endsection
