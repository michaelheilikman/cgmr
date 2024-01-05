<script src="<?= $path ?>node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= $path ?>node_modules/jquery/dist/jquery.min.js"></script>
<script src="https://unpkg.com/typed.js@2.0.15/dist/typed.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src="<?= $path ?>js/main.js?v=<?= $noCacheFile ?>"></script>
<script src="<?= $path ?>js/switch.js?v=<?= $noCacheFile ?>"></script>

<?php 
  if(isset($captcha)){
    echo $captcha->script(); 
  }
?>
<script type="text/javascript">
  var onloadCallback = function() {
    alert("grecaptcha is ready!");
  };
</script>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-FCW7D38BG6"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-FCW7D38BG6');
</script>

<?php if($page != 'projects'): ?>
<script>
$(function(){
    $("#navbar").css("top", "-150px");
    $("#navbar").css("position", "fixed");
    $(document).on('scroll',function () {
        var y = $(this).scrollTop();
        if (y > 300) {
            $("#navbar").css("top", "0");
            $("#navbar").css("position", "fixed");
        } else {
            $("#navbar").css("top", "-150px");
            $("#navbar").css("position", "fixed");
        }
    
    });
})
</script>
<?php endif ?>

<script>
var mySwiper = new Swiper('.mySwiper', {
    // Paramètres de base
    slidesPerView: 3,
    spaceBetween: 30,
    slidesPerGroup: 1,
    loop: true,
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    // Utilisation des breakpoints
    breakpoints: {
        // Quand la largeur de l'écran est inférieure à 768 pixels
        768: {
            slidesPerView: 1, // Une seule image par vue
            spaceBetween: 10, // Espace réduit entre les slides
        },
        1000: {
          slidesPerView: 3,
          spaceBetween: 30,
        }
        // Vous pouvez ajouter d'autres breakpoints si nécessaire
    }
});
</script>


</body>
</html>