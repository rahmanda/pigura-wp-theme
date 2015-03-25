jQuery(document).ready(function() {
    var heart = jQuery(".act-love-wrap a");
    heart.click(function(e){
        e.preventDefault();
        if(!heart.hasClass("voted")) {
            // Retrieve post ID from data attribute
            post_id = heart.data("post_id");
            
            // Ajax call
            jQuery.ajax({
                type: "post",
                url: ajax_var.url,
                data: "action=post-love&nonce="+ajax_var.nonce+"&post_love=&post_id="+post_id,
                success: function(count){
                    // If vote successful
                    if(count != "already")
                    {
                        heart.addClass("voted");
                        // heart.siblings(".count").text(count);
                        jQuery(".voted .act-love").html('<i class="fa fa-heart"></i>&nbsp;&nbsp;Anda Suka</span>');
                        jQuery(".pigura-stats .loves .value").text(count);
                    }
                },
                error: function(jqXHR) {
                    console.log('error');
                }
            });
        } else {
            console.log('no data');
            return false;
        }
    });
});