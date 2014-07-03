 jQuery(document).ready(function($) {
        var count = 2;
        var total = $('#key').attr('data-key');

        var $container = $('.grid-blog');

        $('.post-grid').imagesLoaded( function() {
        $container.packery({
            itemSelector: '.post-grid',
            //transitionDuration:"0.2s",
            gutter: 0
        });
         });


        $(window).scroll(function(){
                if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                   if (count > total){
                        return false;
                   }else{
                      loadArticle(count); 
                     
                   }
                   count++;
                }
        }); 

        function loadArticle(pageNumber){    
        
        var data = {
          action: 'my_action',
          security : MyAjax.security,
          pageNumber:pageNumber
        };
        
        $.post(MyAjax.ajaxurl, data, function(response) {
          var el = $(response);
          el.imagesLoaded( function() {
          $container.append( el ) .packery( 'appended', el );
           });
          
        }
        )};

    });
