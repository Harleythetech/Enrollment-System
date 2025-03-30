<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
        <h5 class="mb-0">Class Database</h5>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addClassModal">Add Data <i class="bi bi-plus-lg"></i></button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Class Code</th>
                <th>Section</th>
                <th>Time</th>
                <th>Course Code</th>
                <th>Prof ID</th>
                <th>Semester Code</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $enrollment_data = data_ClassDB($pdo);
            if (count($enrollment_data) > 0) {
                foreach ($enrollment_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CLASS_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['CLASS_SECTION']) . "</td>
                            <td>" . htmlspecialchars($row['CLASS_TIME']) . "</td>
                            <td>" . htmlspecialchars($row['CRS_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['PROF_NUM']) . "</td>
                            <td>" . htmlspecialchars($row['SEMESTER_CODE']) . "</td>
                            <td>
                                <button class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#editClassModal' 
                                    data-class_code='" . htmlspecialchars($row['CLASS_CODE']) . "' 
                                    data-class_section='" . htmlspecialchars($row['CLASS_SECTION']) . "' 
                                    data-class_time='" . htmlspecialchars($row['CLASS_TIME']) . "' 
                                    data-crs_code='" . htmlspecialchars($row['CRS_CODE']) . "' 
                                    data-prof_num='" . htmlspecialchars($row['PROF_NUM']) . "' 
                                    data-semester_code='" . htmlspecialchars($row['SEMESTER_CODE']) . "'>Edit</button>
                                <a href='?page=ManageDB&subpage=ClassDB&action=delete&id=" . htmlspecialchars($row['CLASS_CODE']) . "' class='btn btn-danger'>Delete</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No records found</td></tr>";
            }
        ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addClassModal" tabindex="-1" aria-labelledby="addClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addClassModalLabel">Add Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="app/main_proc.php">
                    <input type="hidden" name="action" value="add_class">
                    <div class="mb-3">
                        <label class="form-label">Class Code</label>
                        <input type="text" name="class_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <input type="text" name="class_section" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="text" name="class_time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" name="crs_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prof ID</label>
                        <input type="text" name="prof_num" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester Code</label>
                        <input type="text" name="semester_code" class="form-control" required>
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

<!-- Edit Modal -->
<div class="modal fade" id="editClassModal" tabindex="-1" aria-labelledby="editClassModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editClassModalLabel">Edit Class</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="app/main_proc.php">
                    <input type="hidden" name="action" value="edit_class">
                    <input type="hidden" name="class_code" id="edit-class-code">
                    <div class="mb-3">
                        <label class="form-label">Section</label>
                        <input type="text" name="class_section" id="edit-class-section" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Time</label>
                        <input type="text" name="class_time" id="edit-class-time" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" name="crs_code" id="edit-crs-code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prof ID</label>
                        <input type="text" name="prof_num" id="edit-prof-num" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester Code</label>
                        <input type="text" name="semester_code" id="edit-semester-code" class="form-control" required>
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
    var editClassModal = document.getElementById('editClassModal');
    editClassModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('edit-class-code').value = button.getAttribute('data-class_code');
        document.getElementById('edit-class-section').value = button.getAttribute('data-class_section');
        document.getElementById('edit-class-time').value = button.getAttribute('data-class_time');
        document.getElementById('edit-crs-code').value = button.getAttribute('data-crs_code');
        document.getElementById('edit-prof-num').value = button.getAttribute('data-prof_num');
        document.getElementById('edit-semester-code').value = button.getAttribute('data-semester_code');
    });
</script>
