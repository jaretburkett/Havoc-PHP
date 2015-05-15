<?php
?>
<link rel="stylesheet" href="<?php echo $domain; ?>resources/css/snippets/feed.css">
<div class="need-replies">
    <div class="inst-feed-name">
        <span>I Need Someone To</span><br>
        build me a website
        <br><span><?php echo $town ?></span>
    </div>
    <div class="items-feed-replies">

    </div>
</div>

<script>
    // places the stars for raty plugin
    function stars() {
        $('.feed-rating').each(function () {
            $(this).raty({
                score: function () {
                    return $(this).attr('data-score');
                },
                path: '<?php echo $domain; ?>resources/plugins/raty/images/inst',
                readOnly: true
            });
        })
    }
    function loadFeedItem(to, snip, arr) {
        // formulate url get string
        //var toGet = jQuery.param(arr);
        var lnk = "<?php echo $domain; ?>includes/snippets/" + snip + ".php";
        $.post(lnk, arr).done(function (data) {
            $(data).prependTo(to).fadeIn("slow");
            return true;
        });

    }

    // load feed on page load
    $(function () {
        var replies = [
            {
                "pic": "1",
                "name": " Samantha Dior",
                "score": '4',
                "numReviews": '23',
                "location": '<?php echo $town; ?>',
                "bid": '75',
                "description": 'I could get you a simple wordpress site built pretty quickly. When do you need it by?'
            },
            {
                "pic": "2",
                "name": " Teresa Chute",
                "score": '4.5',
                "numReviews": '369',
                "location": '<?php echo $town; ?>',
                "bid": '150',
                "description": 'If you want something professional. I am your gal. I am also very good at SEO (Search Engine' +
                'Optomization) so I can get your rank up on google.'
            },
            {
                "pic": "3",
                "name": "James Allen",
                "score": '2.5',
                "numReviews": '2',
                "location": '<?php echo $town; ?>',
                "bid": '80',
                "description": 'I am free this weekend. Ill set you up.'
            },
            {
                "pic": "4",
                "name": "Carlos Marquez",
                "score": '4',
                "numReviews": '9',
                "location": '<?php echo $town; ?>',
                "bid": '50',
                "description": 'I can get it done tonight if you get me artwork quick.'
            }
        ];
        $.each(replies, function (index, obj) {
            var done = false;
            //obj.reverse(); // reverse order so they appear as above
            done = loadFeedItem('.items-feed-replies', 'feeditem', obj);

            console.log(obj);
        });
    });

    function showDetail(target){
        // remove selected class and hide others selected
        var deselect = $(target).hasClass( "feed-item-selected" );
        $('.feed-item').removeClass('feed-item-selected');
        $('.feed-description').slideUp();

        if(deselect == false){
            $(target).addClass('feed-item-selected');
            $(target).children('.feed-description').slideDown();
        }



    }
</script>