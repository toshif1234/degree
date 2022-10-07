<?php
require_once "../config.php";
include("../template/admin-auth.php");
include("../template/sidebar-admin.php");
?>
<style>
    #Back-btn {
        display: none;
    }

    .container {
        margin-top: 100px
    }

    .counter-box {
        display: block;
        background: #f6f6f6;
        padding: 40px 20px 37px;
        text-align: center
    }

    .counter-box p {
        margin: 5px 0 0;
        padding: 0;
        color: #909090;
        font-size: 18px;
        font-weight: 500
    }

    .counter-box i {
        font-size: 60px;
        margin: 0 0 15px;
        color: #d2d2d2;
        border: 1px solid transparent;
    }

    .counter {
        display: block;
        font-size: 32px;
        font-weight: 700;
        color: #666;
        line-height: 28px
    }

    .counter-box:hover {
        box-shadow: rgba(0, 0, 0, 0.25) 0px 14px 28px, rgba(240, 250, 251, 0.884) 0px 10px 10px;
        transition: background 0.35s;
        background: #7fd4ee8a;
        border: 1px solid transparent;
        border-radius: 7px;
    }

    .text-num {
        color: #0e0f3b;
    }

    .greay {
        color: #07407b !important;
    }

    .orange {
        color: #f7931e !important;
    }

    .counter-box.colored p,
    .counter-box.colored i,
    .counter-box.colored .counter {
        color: #fff;
    }
</style>



<div class="alert alert-success alert-dismissible fade show custom-success-alert" role="alert">
    <strong>Welcome!</strong> You have loged in as Super Admin.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="container">
    <div class="row">
        <div class="four col-md-3 mb-2">
            <a href="../students/student_Select.php">
                <div class="counter-box">
                    <i class="fas fa-user-graduate orange"></i>
                    <span class="counter text-num" data-target="50">0</span>
                    <p class="greay">Total Students</p>
                </div>
            </a>
        </div>
        <div class="four col-md-3 mb-2">
            <a href="../faculty/faculty_department.php">
                <div class="counter-box">
                    <i class="fas fa-chalkboard-teacher orange"></i>
                    <span class="counter text-num" data-target="50">0</span>
                    <p class="greay">Total Faculties</p>
                </div>
            </a>
        </div>
        <div class="four col-md-3 mb-2">
            <!-- <a href="..faculty/faculty_view_details.php"> -->
            <div class="counter-box">
                <i class="fas fa-pencil-ruler orange"></i>
                <span class="counter text-num" data-target="8">0</span>
                <p class="greay">Total Branch's</p>
            </div>
            <!-- </a> -->
        </div>
        <div class="four col-md-3 mb-2">
            <a href="../subject_maping/view_sub.php">
                <div class="counter-box">
                    <i class="fas fa-book-open orange"></i>
                    <span class="counter text-num" data-target="50">0</span>
                    <p class="greay">Total Subjects</p>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
    // DOM Element's
    const counters = document.querySelectorAll('.counter');


    for (let n of counters) {
        const updateCount = () => {
            const target = +n.getAttribute('data-target');
            const count = +n.innerText;
            const speed = 5000000;

            const inc = target / speed;

            if (count < target) {
                n.innerText = Math.ceil(count + inc);
                setTimeout(updateCount, 1);
            } else {
                n.innerText = target;
            }
        }

        updateCount();
    }
</script>
<?php include("../template/footer-admin.php") ?>