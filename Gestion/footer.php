</div>
<footer class="page-footer bg-dark text-center text-white">

    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © <?php echo date("Y"); ?> Copyright. All rights reserved.
    </div>
    <!-- Copyright -->
</footer>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>
<script>
$(document).ready(function() {
    $('.hex-content').click(function(e) {
        e.preventDefault(); 
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
});
</script>
</body>

</html>