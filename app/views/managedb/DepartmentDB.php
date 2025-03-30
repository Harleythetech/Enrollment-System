<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Department Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                Add Data <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Department Code</th>
                <th>Name</th>
                <th>School Code</th>
                <th>Prof ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $enrollment_data = data_DepartmentDB($pdo);
            if (count($enrollment_data) > 0) {
                foreach ($enrollment_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['DEPT_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['DEPT_NAME']) . "</td>
                            <td>" . htmlspecialchars($row['SCHOOL_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_NUM']) . "</td>
                            <td>
                                <button class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#editDepartmentModal' 
                                        data-deptcode='" . htmlspecialchars($row['DEPT_CODE']) . "' 
                                        data-deptname='" . htmlspecialchars($row['DEPT_NAME']) . "' 
                                        data-schoolcode='" . htmlspecialchars($row['SCHOOL_CODE']) . "' 
                                        data-profnum='" . htmlspecialchars($row['PROF_NUM']) . "'>Edit</button>
                                <a href='?page=ManageDB&subpage=DepartmentDB&action=delete&id=" . htmlspecialchars($row['DEPT_CODE']) . "' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No records found</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="add_department">
                    <div class="mb-3">
                        <label class="form-label">Department Code</label>
                        <input type="text" class="form-control" name="dept_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="dept_name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">School Code</label>
                        <input type="text" class="form-control" name="school_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prof ID</label>
                        <input type="text" class="form-control" name="prof_num" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="app/main_proc.php" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="action" value="edit_department">
                    <input type="hidden" name="dept_code" id="editDeptCode">
                    <div class="mb-3">
                        <label class="form-label">Department Name</label>
                        <input type="text" class="form-control" name="dept_name" id="editDeptName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">School Code</label>
                        <input type="text" class="form-control" name="school_code" id="editSchoolCode" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prof ID</label>
                        <input type="text" class="form-control" name="prof_num" id="editProfNum" required>
                    </div>
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
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('editDeptCode').value = this.dataset.deptcode;
            document.getElementById('editDeptName').value = this.dataset.deptname;
            document.getElementById('editSchoolCode').value = this.dataset.schoolcode;
            document.getElementById('editProfNum').value = this.dataset.profnum;
        });
    });
</script>
