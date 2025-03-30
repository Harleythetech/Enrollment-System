<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Student Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addStudentModal">
                Add Data <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>DEPT Code</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Initial</th>
                <th>Email</th>
                <th>PROF_NUM</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Fetch data from the database and display it in the table
            $students = data_StudentDB($pdo);
            if (count($students) > 0) {
                foreach ($students as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['STU_NUM']) . "</td>
                            <td>" . htmlspecialchars($row['DEPT_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['STU_LNAME']) . "</td>
                            <td>" . htmlspecialchars($row['STU_FNAME']) . "</td>
                            <td>" . htmlspecialchars($row['STU_INITIAL']) . "</td>
                            <td>" . htmlspecialchars($row['STU_EMAIL']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_NUM']) . "</td>
                            <td>
                                <button class='btn btn-primary editStudentBtn'
                                        data-id='{$row['STU_NUM']}'
                                        data-dept='{$row['DEPT_CODE']}'
                                        data-lname='{$row['STU_LNAME']}'
                                        data-fname='{$row['STU_FNAME']}'
                                        data-initial='{$row['STU_INITIAL']}'
                                        data-email='{$row['STU_EMAIL']}'
                                        data-prof='{$row['PROF_NUM']}'
                                        data-bs-toggle='modal' data-bs-target='#editStudentModal'>
                                    Edit
                                </button>
                                <a href='?page=ManageDB&subpage=StudentDB&action=delete&id=" . htmlspecialchars($row['STU_NUM']) . "' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='8' class='text-center'>No records found</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add_student">
                    <label>Student ID</label>
                    <input type="text" name="stu_num" class="form-control" required>

                    <label>Department Code</label>
                    <input type="text" name="dept_code" class="form-control" required>

                    <label>Last Name</label>
                    <input type="text" name="stu_lname" class="form-control" required>

                    <label>First Name</label>
                    <input type="text" name="stu_fname" class="form-control" required>

                    <label>Initial</label>
                    <input type="text" name="stu_initial" class="form-control">

                    <label>Email</label>
                    <input type="email" name="stu_email" class="form-control" required>

                    <label>Professor Number</label>
                    <input type="text" name="prof_num" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_student">
                    <input type="hidden" id="editStuNum" name="stu_num">

                    <label>Department Code</label>
                    <input type="text" id="editDeptCode" name="dept_code" class="form-control" required>

                    <label>Last Name</label>
                    <input type="text" id="editStuLname" name="stu_lname" class="form-control" required>

                    <label>First Name</label>
                    <input type="text" id="editStuFname" name="stu_fname" class="form-control" required>

                    <label>Initial</label>
                    <input type="text" id="editStuInitial" name="stu_initial" class="form-control">

                    <label>Email</label>
                    <input type="email" id="editStuEmail" name="stu_email" class="form-control" required>

                    <label>Professor Number</label>
                    <input type="text" id="editProfNum" name="prof_num" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editStudentModal = document.getElementById('editStudentModal');
        editStudentModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            document.getElementById('editStuNum').value = button.getAttribute('data-id');
            document.getElementById('editDeptCode').value = button.getAttribute('data-dept');
            document.getElementById('editStuLname').value = button.getAttribute('data-lname');
            document.getElementById('editStuFname').value = button.getAttribute('data-fname');
            document.getElementById('editStuInitial').value = button.getAttribute('data-initial');
            document.getElementById('editStuEmail').value = button.getAttribute('data-email');
            document.getElementById('editProfNum').value = button.getAttribute('data-prof');
        });
    });
</script>
