
</div>
<footer class="page-footer bg-dark text-center text-white">
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © <?php echo date("Y"); ?> Copyright. All rights reserved.
  </div>
  <!-- Copyright -->
</footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js" integrity="sha512-FHZVRMUW9FsXobt+ONiix6Z0tIkxvQfxtCSirkKc5Sb4TKHmqq1dZa8DphF0XqKb3ldLu/wgMa8mT6uXiLlRlw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- fullcalendar -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="evennement/fullcalendar.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // menu style in case page displayed//
    $('.hex-content').click(function(e) {
        $('.hex-item').children().css('background','transparent');
        $('.hex-item:first-child').css('transform', 'scale(1)');
        $('.hex-content svg').css({'transform':'scale(0.87)','transition':'0.3s'});
        $('.hex-content .icon i').css({'color':'#fff','transition':'0.6s'});
        var hexChildren = $(this).closest('.hexagon-item').children('.hex-item');
        var hexItem = $(this).closest('.hexagon-item').find('.hex-item:first-child');
        var hexcontent = $(this).closest('.hexagon-item').find('.hex-content svg');
        var hexicone = $(this).closest('.hexagon-item').find('.hex-content .icon i');
        hexicone.css({'color':'#05dd9a','transition':'0.6s'});
        hexcontent.css({'transform':'scale(0.97)','transition':'0.3s'});
        hexItem.css('transform', 'scale(1.2)');
        hexChildren.children().css('background','#05dd9a');
    });
    // menu style in case user role/
    var role=<?php echo $idRole ?>;
    if(role!=1){
     $('#hexagon_content').css('display','grid');
     $('#hexagon_content').css('grid-template-columns','repeat(2, auto)');
     $('#hexagon_content').css('grid-template-rows','repeat(2, auto)');
     $('.hexagon-item').css('margin-left','-13px');
     $('#hexagon_content').css('margin-top','34px');
     $('.hexagon-item').css('margin-bottom','-13px');
     $('#hexagon_content').css('margin-left','0px');
     }
});
</script>
</body>

</html>