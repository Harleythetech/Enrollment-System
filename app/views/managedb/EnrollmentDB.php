<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Enrollment Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addEnrollmentModal">
                Add Data <i class="bi bi-plus-lg"></i>
            </button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Class Code</th>
                <th>Student ID</th>
                <th>Enroll Date</th>
                <th>Enroll Grade</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $enrollment_data = data_EnrollmentDB($pdo);
            if (count($enrollment_data) > 0) {
                foreach ($enrollment_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CLASS_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['STU_NUM']) . "</td>
                            <td>" . htmlspecialchars($row['ENROLL_DATE']) . "</td>
                            <td>" . htmlspecialchars($row['ENROLL_GRADE']) . "</td>
                            <td>
                                <button class='btn btn-primary edit-btn' 
                                    data-bs-toggle='modal' data-bs-target='#editEnrollmentModal'
                                    data-classcode='" . htmlspecialchars($row['CLASS_CODE']) . "'
                                    data-stunum='" . htmlspecialchars($row['STU_NUM']) . "'
                                    data-enrolldate='" . htmlspecialchars($row['ENROLL_DATE']) . "'
                                    data-enrollgrade='" . htmlspecialchars($row['ENROLL_GRADE']) . "'>
                                    Edit
                                </button>
                                <a href='?page=ManageDB&subpage=EnrollmentDB&action=delete&id=" . htmlspecialchars($row['CLASS_CODE']) . "' 
                                    class='btn btn-danger'>Delete</a>
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

<!-- Add Enrollment Modal -->
<div class="modal fade" id="addEnrollmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="app/main_proc.php">
                    <input type="hidden" name="action" value="add_enrollment">
                    <div class="mb-3">
                        <label class="form-label">Class Code</label>
                        <input type="text" class="form-control" name="class_code" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" class="form-control" name="stu_num" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Enroll Date</label>
                        <input type="date" class="form-control" name="enroll_date" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Enroll Grade</label>
                        <input type="text" class="form-control" name="enroll_grade" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Enrollment Modal -->
<div class="modal fade" id="editEnrollmentModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="app/main_proc.php">
                    <input type="hidden" name="action" value="edit_enrollment">
                    <input type="hidden" name="class_code" id="edit-classcode">
                    <div class="mb-3">
                        <label class="form-label">Student ID</label>
                        <input type="text" class="form-control" name="stu_num" id="edit-stunum" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Enroll Date</label>
                        <input type="date" class="form-control" name="enroll_date" id="edit-enrolldate" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Enroll Grade</label>
                        <input type="text" class="form-control" name="enroll_grade" id="edit-enrollgrade" required>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".edit-btn").forEach(button => {
            button.addEventListener("click", function() {
                document.getElementById("edit-classcode").value = this.getAttribute("data-classcode");
                document.getElementById("edit-stunum").value = this.getAttribute("data-stunum");
                document.getElementById("edit-enrolldate").value = this.getAttribute("data-enrolldate");
                document.getElementById("edit-enrollgrade").value = this.getAttribute("data-enrollgrade");
            });
        });
    });
</script>
