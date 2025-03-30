<?php
$subpage = isset($_GET['subpage']) ? $_GET['subpage'] : 'EnrollmentDB';
$subfile = "app/views/managedb/{$subpage}.php";
?>
<div class="row mt-3">
    <div class="col-2 navbg py-3 rounded rounded-3 shadow-sm h-50">
        <div class="p-2 text-start mb-2">
            <p class="mb-0">System Data Management</p>
        </div>
        <hr class="mb-1 mt-0">
        <div class="btn-group-vertical w-100">
            <a href="?page=ManageDB&subpage=EnrollmentDB" type="button"
                class="btn text-start rounded-pill <?php echo ($subpage === 'EnrollmentDB') ? 'active bg-success text-white' : ''; ?>">Enrollment</a>
            <a href="?page=ManageDB&subpage=StudentDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'StudentDB') ? 'active bg-success text-white' : ''; ?>">Students</a>
            <a href="?page=ManageDB&subpage=ProfDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'ProfDB') ? 'active bg-success text-white' : ''; ?>">Professors</a>
            <a href="?page=ManageDB&subpage=CourseDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'CourseDB') ? 'active bg-success text-white' : ''; ?>">Courses</a>
            <a href="?page=ManageDB&subpage=ClassDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'ClassDB') ? 'active bg-success text-white' : ''; ?>">Classes</a>
            <a href="?page=ManageDB&subpage=SemesterDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'SemesterDB') ? 'active bg-success text-white' : ''; ?>">Semesters</a>
            <a href="?page=ManageDB&subpage=DepartmentDB" type="button"
                class="btn text-start rounded-pill <?php echo ($subpage === 'DepartmentDB') ? 'active bg-success text-white' : ''; ?>">Departments</a>
            <a href="?page=ManageDB&subpage=SchoolDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'SchoolDB') ? 'active bg-success text-white' : ''; ?>">School</a>
            <a href="?page=ManageDB&subpage=Building" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'Building') ? 'active bg-success text-white' : ''; ?>">Building</a>
            <a href="?page=ManageDB&subpage=RoomDB" type="button" 
                class="btn text-start rounded-pill <?php echo ($subpage === 'RoomDB') ? 'active bg-success text-white' : ''; ?>">Room</a>
        </div>
    </div>
    <div class="col">
        <?php
        if (file_exists($subfile)) {
            include $subfile;
        } else {
            echo "<p>Page not found: " . htmlspecialchars($subfile) . "</p>";
        }
        ?>
    </div>
</div>