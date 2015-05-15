
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="resources/js/embed.js"></script>
<script src="resources/js/bootstrap.min.js"></script>


<!-- Include jQuery and the jQuery.mmenu .js files -->
<script type="text/javascript" src="resources/plugins/mmenu/js/jquery.mmenu.min.all.js"></script>
<script src="resources/plugins/mmenu/js/addons/jquery.mmenu.fixedelements.min.js" type="text/javascript"></script>

<script src="resources/js/typed2.js"></script>
<script src="resources/js/parallax.min.js"></script>
<script src="resources/plugins/raty/jquery.raty.js"></script>
<!-- Fire the plugin onDocumentReady -->
<script type="text/javascript">
    jQuery(document).ready(function( $ ) {
        $("#menu").mmenu({
            "extensions": [
                "border-none",
                "effect-slide-menu",
                "effect-slide-panels-100",
                "pageshadow"
            ],
            "navbars": [
                {
                    "position": "bottom",
                    "content": [
                        "<a>Jaret Burkett</a>"
                    ]
                }
            ],
            "searchfield": {
                "placeholder": "I Need Someone Too...",
                "add": true,
                "search": true
            }
        });
    });
</script>
<script>
    $(function () {
        function shuffle(array) {
            var currentIndex = array.length, temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }

            return array;
        }

        var typer = [
            'mow my grass',
            'paint my bedroom',
            'fix my car',
            'bring me lunch',
            'fix my computer',
            'give me a ride',
            'build a website',
            'give me guitar lessons',
            'clean my house',
            'wash my car',
            'fix my phone',
            'sell my stuff',
            'retile my floor',
            'do my makeup',
            'trim my trees',
            'install a sprinkler system',
            'teach me piano',
            'fix my toilet',
            'babysit my son',
            'clean my gutters',
            'do data entry',
            'wash my clothes'
        ];

        // shuffle the array
        typer = shuffle(typer);

        $("#inst-input").typed({
            strings: typer,
            // typing speed
            typeSpeed: 20,
            // time before typing starts
            startDelay: 500,
            // backspacing speed
            backSpeed: 0,
            // time before backspacing
            backDelay: 1000,
            // loop
            loop: true,
            // false = infinite
            loopCount: false,
            // show cursor
            showCursor: false,
            // character for cursor
            cursorChar: "|",
            // attribute to type (null == text)
            attr: null,
            // either html or text
            contentType: 'text',
            // call when done callback function
            callback: function () {
            },
            // starting callback function before each string
            preStringTyped: function () {
            },
            //callback for every typed string
            onStringTyped: function () {
            },
            // callback for reset
            resetCallback: function () {
            }
        });


    });



    $(function () {

// show title and then acronym
        setTimeout(function () {
            $(".tf").animate({
                opacity: "1",
                fontSize: "20px"
            }, 2000);

        }, 1000);
        setTimeout(function () {
            $(".tf").animate({
                opacity: "0",
                fontSize: "0px"
            }, 2000);
        }, 4000);


        // run parallax
// listen for click an stop typer
        $('#inst-input').click(function () {

            $('#inst-input').data('typed').stop();
            $("#inst-input").val('');
        });

    });

</script>