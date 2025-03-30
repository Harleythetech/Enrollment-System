<div>
    <div class="navbg p-3 rounded rounded-3 shadow-sm">
        <div class="d-flex justify-content-between flex-wrap align-items-center">
            <h5 class="mb-0">Course Database</h5>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addCourseModal">Add Data <i class="bi bi-plus-lg"></i></button>
        </div>
    </div>

    <table class="table table-striped table-hover table-bordered mt-3">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Title</th>
                <th>Description</th>
                <th>Credit</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $course_data = data_CourseDB($pdo);
            if (count($course_data) > 0) {
                foreach ($course_data as $row) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CRS_CODE']) . "</td>
                            <td>" . htmlspecialchars($row['CRS_TITLE']) . "</td>
                            <td>" . htmlspecialchars($row['CRS_DESCRIPTION']) . "</td>
                            <td>" . htmlspecialchars($row['CRS_CREDIT']) . "</td>
                            <td>
                                <button class='btn btn-primary edit-btn' data-bs-toggle='modal' data-bs-target='#editCourseModal' 
                                    data-crs_code='" . htmlspecialchars($row['CRS_CODE']) . "' 
                                    data-crs_title='" . htmlspecialchars($row['CRS_TITLE']) . "' 
                                    data-crs_description='" . htmlspecialchars($row['CRS_DESCRIPTION']) . "' 
                                    data-crs_credit='" . htmlspecialchars($row['CRS_CREDIT']) . "'>Edit</button>
                                <a href='?page=ManageDB&subpage=CourseDB&action=delete&id=" . htmlspecialchars($row['CRS_CODE']) . "' class='btn btn-danger'>Delete</a>
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

<!-- Add Course Modal -->
<div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCourseModalLabel">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="app/main_proc.php">
                    <input type="hidden" name="action" value="add_course">
                    <div class="mb-3">
                        <label class="form-label">Course Code</label>
                        <input type="text" name="crs_code" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="crs_title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="crs_description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Credit</label>
                        <input type="number" name="crs_credit" class="form-control" required>
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

<!-- Edit Course Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="app/main_proc.php">
                    <input type="hidden" name="action" value="edit_course">
                    <input type="hidden" name="crs_code" id="edit-crs-code">
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="crs_title" id="edit-crs-title" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="crs_description" id="edit-crs-description" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Credit</label>
                        <input type="number" name="crs_credit" id="edit-crs-credit" class="form-control" required>
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
    var editCourseModal = document.getElementById('editCourseModal');
    editCourseModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        document.getElementById('edit-crs-code').value = button.getAttribute('data-crs_code');
        document.getElementById('edit-crs-title').value = button.getAttribute('data-crs_title');
        document.getElementById('edit-crs-description').value = button.getAttribute('data-crs_description');
        document.getElementById('edit-crs-credit').value = button.getAttribute('data-crs_credit');
    });
</script>
