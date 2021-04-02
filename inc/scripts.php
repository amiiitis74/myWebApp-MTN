        <script src="../js/wow.js"></script>
        <script>
            wow = new WOW(
              {
                animateClass: 'animated',
                offset:       100,
                callback:     function(box) {
                  console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
                }
              }
            );
            wow.init();
        </script>

        <!-- paging -->
        <script src="../js/pagerJs.js" type="text/javascript"></script>
        <script>
            let pager = new Pager('pager', 8);
            pager.init();
            pager.showPageNav('pager', 'pageNavPosition');
            pager.showPage(1);
        </script>
        <!-- paging -->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="../js/jquery-3.5.1.min.js" type="text/javascript"></script> 
        <script src="../js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="../v6.5.0-dist/ol.js" type="text/javascript"></script>         
        <script src="../js/tableSorter.js" type="text/javascript"></script>
        
        <script src="../js/myJs.js" type="text/javascript"></script>
        

        
    