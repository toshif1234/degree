</div>
<div>
    <!-- Button trigger modal -->
    <a class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal" style="position: fixed;left: 0;
bottom: 0;">
        <i class="fas fa-question-circle d-flex" style="font-size: 30px; color:#818181;"></i>
    </a>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Saw mobile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="p-3" id="saw-mobile">
                        <img src="../asset/img/qrcode.png" class="img-fluid " alt="qrcode">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page content end -->
</div>
</div>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script> -->
<!-- <script>
    $(document).ready(function() {
        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
    });
</script> -->
<style>
    .error {
        border: 1px solid red;
    }
</style>
<script>
    submitError = true
    var selects = document.getElementsByTagName('select');
    var sel;

    function validate() {
        for (var z = 0; z < selects.length; z++) {
            sel = selects[z];
            if (sel.value != "") {
                sel.classList.remove("error");
                submitError = false;
            } else {
                sel.classList.add("error");
                submitError = true;
            }
        }

    }
    // validate();  
</script>
</body>

</html>