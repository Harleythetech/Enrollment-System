<?php
$dashboardStats = getDashboardStats($pdo);
$recentEnrollments = getRecentData($pdo, "SELECT E.CLASS_CODE, E.STU_NUM, E.ENROLL_DATE, E.ENROLL_GRADE FROM enroll E ORDER BY E.ENROLL_DATE DESC LIMIT 5");

$recentProfessors = getRecentData($pdo, "SELECT PROF_NUM, PROF_LNAME, PROF_FNAME, PROF_EMAIL FROM PROFESSOR ORDER BY PROF_NUM DESC LIMIT 5");

$recentCourses = getRecentData($pdo, "SELECT CRS_CODE, CRS_TITLE, CRS_CREDIT FROM COURSE ORDER BY CRS_CODE DESC LIMIT 5");

$recentClasses = getRecentData($pdo, "SELECT CLASS_CODE, CLASS_SECTION, CRS_CODE, SEMESTER_CODE FROM CLASS ORDER BY CLASS_CODE DESC LIMIT 5");

?>

<div>
    <div class="d-flex align-items-center justify-content-between flex-wrap py-4">
    <h2 class="mb-0">Dashboard</h2>
    <p  class="mb-0" id="greeting"></p>
    </div>
    <div class="row row-cols-1 row-cols-md-4">
        <div class="col p-2">
            <div class="navbg p-3 rounded rounded-3 shadow-sm">
                <div class="d-flex justify-content-between flex-wrap align-items-center">
                    <p class="mb-0">Students Enrolled</p>
                    <h3 class="mb-0"><?= $dashboardStats["total_students"] ?></h3>
                </div>
            </div>
        </div>
        <div class="col p-2">
        <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
                    <p class="mb-0">Professors Enrolled</p>
                    <h3 class="mb-0"><?= $dashboardStats["total_professors"] ?></h3>
                </div>
            </div>
        </div>
        <div class="col p-2">
        <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
                    <p class="mb-0">Course Offered</p>
                    <h3 class="mb-0"><?= $dashboardStats["total_courses"] ?></h3>
                </div>
            </div>
        </div>
        <div class="col p-2">
        <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
                    <p class="mb-0">Active Classes</p>
                    <h3 class="mb-0"><?= $dashboardStats["total_active_classes"] ?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <!-- Recent Enrollments -->
    <div class="col-md-6">
        <h5>Recent Enrollments</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Class Code</th>
                    <th>Student ID</th>
                    <th>Enroll Date</th>
                    <th>Enroll Grade</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentEnrollments as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['CLASS_CODE']) ?></td>
                        <td><?= htmlspecialchars($row['STU_NUM']) ?></td>
                        <td><?= htmlspecialchars($row['ENROLL_DATE']) ?></td>
                        <td><?= htmlspecialchars($row['ENROLL_GRADE']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Recent Professors -->
    <div class="col-md-6">
        <h5>Recent Professors</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentProfessors as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['PROF_NUM']) ?></td>
                        <td><?= htmlspecialchars($row['PROF_LNAME']) ?></td>
                        <td><?= htmlspecialchars($row['PROF_FNAME']) ?></td>
                        <td><?= htmlspecialchars($row['PROF_EMAIL']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="row">
    <!-- Recent Courses -->
    <div class="col-md-6">
        <h5>Recent Courses</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Title</th>
                    <th>Credits</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentCourses as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['CRS_CODE']) ?></td>
                        <td><?= htmlspecialchars($row['CRS_TITLE']) ?></td>
                        <td><?= htmlspecialchars($row['CRS_CREDIT']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Recent Classes -->
    <div class="col-md-6">
        <h5>Recent Classes</h5>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Class Code</th>
                    <th>Section</th>
                    <th>Course</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentClasses as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['CLASS_CODE']) ?></td>
                        <td><?= htmlspecialchars($row['CLASS_SECTION']) ?></td>
                        <td><?= htmlspecialchars($row['CRS_CODE']) ?></td>
                        <td><?= htmlspecialchars($row['SEMESTER_CODE']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</div>