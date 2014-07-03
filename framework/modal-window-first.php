<?php function cr_first_vizit_style() { ?>
<style>
    
#mask {
    background-color: #000;
    display: none;
    left: 0;
    position: absolute;
    top: 0;
    z-index: 9000;
}
#boxes .window {
    display: none;
    height: 200px;
    left: 0;
    overflow: hidden;
    padding: 20px;
    position: absolute;
    top: 0;
    width: 440px;
    z-index: 9999;
}
#boxes #dialog {
    background-color: #ffffff;
    height: 203px;
    padding: 10px;
    width: 375px;
}
.top {
    border-bottom: 1px solid;
    height: 35px;
    left: 0;
    padding: 8px 20px 6px 10px;
    position: absolute;
    top: 0;
    width: 100%;
}
.close {
    border-left: 1px solid;
    cursor: pointer;
    height: 100%;
    padding: 0 7px;
    position: fixed;
    right: 0;
    top: 0;
}
.content {
    padding-top: 35px;
}
</style>
<?php }

	function cr_first_vizit_data() { ?>
    <!-- Само окно -->
<div id="boxes">  
    <div id="dialog" class="window">
        <div class="top">Заголовок модального окна<i class="link close fa fa-times fa-2x"></i></div>
        <div class="content">Текст в модальном окне.</div>
    </div>
</div>

<!-- Маска, затемняющая фон -->
<div id="mask"></div>


    <script type="text/javascript">
    	(function($) {
            $(document).ready(function() {  
                setTimeout(function () {
                    var id = $('#dialog');
                    var maskHeight = $(document).height();
                    var maskWidth = $(window).width();
                    $('#mask').css({'width':maskWidth,'height':maskHeight});
                    $('#mask').fadeIn(1000); 
                    $('#mask').fadeTo("slow",0.8); 
                    var winH = $(window).height();
                    var winW = $(window).width();
                    $(id).css('top',  winH/2-$(id).height()/2);
                    $(id).css('left', winW/2-$(id).width()/2);
                    $(id).fadeIn(2000); 
                }, 5000);
                $('.window .close,#mask').click(function (e) { 
                    e.preventDefault();
                    $('#mask, .window').fadeOut('slow');
                }); 

           });
        })( jQuery);
    </script>
<?php } 

//add_action('cr_top_head','cr_first_vizit_style');
//add_action('cr_top_head','cr_first_vizit_data');