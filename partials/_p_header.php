<?php
session_start();
$name = $_SESSION['name'];
$is_doctor = $_SESSION['is_doctor'];
$gender = $_SESSION['gender'];
if($is_doctor){
    $title = "Dr. ";
}else{
    if($gender == "Male"){
        $title = "Mr. ";
    }else{
        $title = "Mrs. ";
    }
}
session_abort();
?>

<header class="bg-light p-3 d-flex align-items-center">
    <!-- Navbar or any other header content -->
    <div class="container mt-5 d-flex align-items-center">
        <!-- Use Bootstrap's button styles for links that look like buttons -->
        <a href="main.php" class="btn btn-secondary d-inline-flex align-items-center justify-content-center me-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left me-2" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
            </svg>
            Go Back
        </a>
        <h2 class="mb-0">KUMHRS&nbsp;&nbsp;<?php echo $title.$name?></h2>
    </div>
</header>