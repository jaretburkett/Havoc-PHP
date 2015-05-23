<?php
?>

<style>
    .loading-screen{
        display:none;
        position: fixed;
        z-index: 100000;
        top:0;
        left:0;
        right:0;
        bottom:0;
        width: 100%;
        height: 100%;
        background-color:rgba(180, 180, 180, 0.8);
    }
    .loading-center{
        position: relative;
        top:50%;
        transform: translateY(-50%);
        margin: auto;
        border: 2px solid #000;
        background: url(<?php echo $domain; ?>/resources/img/spinner.gif);
        background-size: 80px 80px;
        background-repeat: no-repeat;
        background-position: center;
        background-color: #fff;
        width: 84px;
        height: 84px;
        border-radius: 42px;
        text-align: center;
        box-shadow: 0px 4px 14px rgba(0, 0, 0, 0.8);
        -webkit-transition: all 0.5s ease-in-out;
        -moz-transition: all 0.5s ease-in-out;
        -o-transition: all 0.5s ease-in-out;
        transition: all 0.5s ease-in-out;
    }
    .loading-center img {
        height: 60px;
        width: auto;
        position: relative;
        top: 50%;
        transform: translateY(-50%);
    }
</style>
<div class="loading-screen">
    <div class="loading-center">
        <img src="<?php echo $domain; ?>/resources/img/icon-100px.png" />

    </div>

</div>

<script>
    // turn on loading with loading('on'); and turn off with loading('off');
    function loading(state){
        if(state == 'on'){
            $('.loading-screen').fadeIn();
        } else if (state == 'off'){
            $('.loading-screen').fadeOut();
        }
    }
</script>