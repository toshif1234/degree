<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .scroll{
                position: fixed;
                 bottom:0 ;
                 right:0; 
                 border-radius: 60% !important;
                 display: none;
            }
            

        </style>
    <button class="btn btn-info btn-lg m-4 scroll" id="scroll-btn" onclick="scrollWin()"> <i id="arrow" class="fas fa-chevron-down mt-1"></i></button>
    <script>
        var mybutton = document.getElementById("scroll-btn");

        window.onscroll = function() {scrollFunction();
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                var element = document.getElementById("arrow");
            }
            // alert(window.innerHeight + window.scrollY + "::::" + document.body.offsetHeight);

            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
                
                element.classList.remove("fa-chevron-down");
                element.classList.add("fa-chevron-up");
            }
            else{
                element.classList.remove("fa-chevron-up");
                element.classList.add("fa-chevron-down");
            }
        
        
        };
        

        

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        function scrollWin() {
            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {

                    window.scroll({
                    top:0,
                    behavior: 'smooth' 
                });
            }
            else{
                window.scroll({
                    top:document.body.scrollHeight,
                    behavior: 'smooth' 
                });
            }
         
        }
    </script>