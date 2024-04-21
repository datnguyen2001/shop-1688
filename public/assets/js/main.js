/*js icon menu bar*/
function myFunction(x) {
    x.classList.toggle("change");
}

// ?jquery mobile
(function($) {
    var $main_nav = $('#main-nav');
    var $toggle = $('.toggle');

    var defaultData = {
        maxWidth: false,
        customToggle: $toggle,
        // navTitle: 'All Categories',
        levelTitles: true,
        pushContent: '#container'
    };

    // add new items to original nav
    $main_nav.find('li.add').children('a').on('click', function() {
        var $this = $(this);
        var $li = $this.parent();
        var items = eval('(' + $this.attr('data-add') + ')');

        $li.before('<li class="new"><a>'+items[0]+'</a></li>');

        items.shift();

        if (!items.length) {
            $li.remove();
        }
        else {
            $this.attr('data-add', JSON.stringify(items));
        }

        Nav.update(true);
    });

    // call our plugin
    var Nav = $main_nav.hcOffcanvasNav(defaultData);

    // demo settings update

    const update = (settings) => {
        if (Nav.isOpen()) {
            Nav.on('close.once', function() {
                Nav.update(settings);
                Nav.open();
            });

            Nav.close();
        }
        else {
            Nav.update(settings);
        }
    };

    $('.actions').find('a').on('click', function(e) {
        e.preventDefault();

        var $this = $(this).addClass('active');
        var $siblings = $this.parent().siblings().children('a').removeClass('active');
        var settings = eval('(' + $this.data('demo') + ')');

        update(settings);
    });

    $('.actions').find('input').on('change', function() {
        var $this = $(this);
        var settings = eval('(' + $this.data('demo') + ')');

        if ($this.is(':checked')) {
            update(settings);
        }
        else {
            var removeData = {};
            $.each(settings, function(index, value) {
                removeData[index] = false;
            });

            update(removeData);
        }
    });
})(jQuery);


// end mobile



/*js home slider banner*/
$('#slider-home').owlCarousel({
    loop:true,
    margin:0,
    dots:false,
    nav:true,
    autoplay:true,
    autoplayTimeout:5000,
    autoplaySpeed:1500,
    navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});



$('.slider-large').owlCarousel({
    items:1,
    loop:false,
    center:false,
    margin:10,
    navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    nav:true,

});
$('.slider-small').owlCarousel({
    items:4,
    loop:false,
    center:false,
    margin:10,
    URLhashListener:true,
    autoplayHoverPause:true,
    nav:false,
    startPosition: 'URLHash',

});
$(document).ready(function () {
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('.backtotop').fadeIn();
        }
        else {
            $('.backtotop').fadeOut();
        }
    });
    $('.backtotop').click(function () {
        $('body,html').animate({scrollTop: 0}, 800);
    })
});
/*
$(document).ready(function(e) {

  $(".set > .click-parent").on("click", function(e) {
     e.preventDefault();
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
      $(this)
        .siblings(".content")
        .slideUp(200);
      $(".set > .click-parent i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
    } else {
      $(".set > .click-parent i")
        .removeClass("fa-minus")
        .addClass("fa-plus");
      $(this)
        .find("i")
        .removeClass("fa-plus")
        .addClass("fa-minus");
      $(".set > .click-parent").removeClass("active");
      $(this).addClass("active");
      $(".content").slideUp(200);
      $(this)
        .siblings(".content")
        .slideDown(200);
    }
  });
});
*/

$(function(){
    var container = $('.upload-file'), inputFile = $('#file'), img, btn, txt = 'Táº£i lĂªn áº£nh Ä‘áº¡i diá»‡n má»›i', txtAfter = 'Browse another pic';

    if(!container.find('#upload').length){
        container.find('.input').append('<input type="button" value="'+txt+'" id="upload">');
        btn = $('#upload');
        container.prepend('<img src="" class="hidden" alt="Uploaded file" id="uploadImg" width="100">');
        img = $('#uploadImg');
    }

    btn.on('click', function(){
        img.animate({opacity: 0}, 300);
        inputFile.click();
    });

    inputFile.on('change', function(e){
        container.find('label').html( inputFile.val() );

        var i = 0;
        for(i; i < e.originalEvent.srcElement.files.length; i++) {
            var file = e.originalEvent.srcElement.files[i],
                reader = new FileReader();

            reader.onloadend = function(){
                img.attr('src', reader.result).animate({opacity: 1}, 700);
            }
            reader.readAsDataURL(file);
            img.removeClass('hidden');
        }

        btn.val( txtAfter );
    });
});
$(document).ready(function() {
    $(".hide1").click(function() {
        $(this).closest('.right').find('.box-box').first().hide();
        //         $(".box-box").hide();
    });
    $(".show").click(function() {
        $(this).closest('.right').find('.box-box').first().show();
        //         $(".box-box").show();
    });
});
