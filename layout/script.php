 <!-- Back to Top -->
 <a href="#" class="btn btn-lg btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>
<script src="lib/isotope/isotope.pkgd.min.js"></script>
<script src="lib/lightbox/js/lightbox.min.js"></script>

<script src="js/aos.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>

<script>
    document.body.onload = function () {
        function count($this) {
            var current = parseInt($this.html(), 10);
            current = current + 1; /* Where 1 is increment */

            $this.html(++current);
            if (current > $this.data('count')) {
                $this.html($this.data('count'));
            } else {
                setTimeout(function () { count($this) }, 50);
            }
        }

        jQuery(".stat-count").each(function () {
            jQuery(this).data('count', parseInt(jQuery(this).html(), 10));
            jQuery(this).html('0');
            count(jQuery(this));
        });
    };
</script>
<script>
    AOS.init({
        easing: 'ease-out-back',
        duration: 1000
    });
</script>
</body>

</html>