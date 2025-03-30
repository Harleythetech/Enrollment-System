<?php
include(__DIR__ . '/database.php');
header("Content-Type: text/html; charset=UTF-8");


// Stats

function getDashboardStats($pdo) {
    $stats = [];

    $queries = [
        "total_students" => "SELECT COUNT(*) AS total FROM STUDENT",
        "total_professors" => "SELECT COUNT(*) AS total FROM PROFESSOR",
        "total_courses" => "SELECT COUNT(*) AS total FROM COURSE",
        "total_active_classes" => "SELECT COUNT(*) AS total FROM CLASS WHERE SEMESTER_CODE = (SELECT SEMESTER_CODE FROM SEMESTER ORDER BY SEMESTER_START_DATE DESC LIMIT 1)"
    ];

    foreach ($queries as $key => $sql) {
        $stmt = $pdo->query($sql);
        $stats[$key] = $stmt->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    }

    return $stats;
}

function getRecentData($pdo, $query) {
    $stmt = $pdo->query($query);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// fucntion for Enrollement DB
function data_EnrollmentDB($pdo)
{
    try {
        $EnrollmentDB_Query = $pdo->prepare("SELECT * FROM enroll;");
        $EnrollmentDB_Query->execute();
        return $EnrollmentDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}


// Functions for StudentDB
function data_StudentDB($pdo)
{
    try {
        $StudentDB_Query = $pdo->prepare("SELECT * FROM student;");
        $StudentDB_Query->execute();
        return $StudentDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}


// Functions for ProfessorsDB
function data_professorsDB($pdo)
{
    try {
        $ProfDB_Query = $pdo->prepare("SELECT * FROM professor;");
        $ProfDB_Query->execute();
        return $ProfDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}


function data_CourseDB($pdo)
{
    try {
        $CourseDB_Query = $pdo->prepare("SELECT * FROM course;");
        $CourseDB_Query->execute();
        return $CourseDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}

// Functions for ClassDB
function data_ClassDB($pdo)
{
    try {
        $ClassDB_Query = $pdo->prepare("SELECT * FROM class;");
        $ClassDB_Query->execute();
        return $ClassDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}

// Functions for SemestersDB
function data_SemestersDB($pdo)
{
    try {
        $SemestersDB_Query = $pdo->prepare("SELECT * FROM semester;");
        $SemestersDB_Query->execute();
        return $SemestersDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error:" . $e->getMessage());
        return [];
    }
}

// Functions for DepartmentsDB
function data_DepartmentDB($pdo)
{
    try {
        $DepartmentDB_Query = $pdo->prepare("SELECT * FROM department;");
        $DepartmentDB_Query->execute();
        return $DepartmentDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}


// Functions for SchoolDB
function data_SchoolDB($pdo)
{
    try {
        $SchoolDB_Query = $pdo->prepare("SELECT * FROM school;");
        $SchoolDB_Query->execute();
        return $SchoolDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error:" . $e->getMessage());
        return [];
    }
}


// Functions for BuildingDB
function data_BuildingDB($pdo)
{
    try {
        $BuildingDB_Query = $pdo->prepare("SELECT * FROM building;");
        $BuildingDB_Query->execute();
        return $BuildingDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error:" . $e->getMessage());
        return [];
    }
}



// Functions for RoomDB
function data_roomDB($pdo)
{
    try {
        $RoomDB_Query = $pdo->prepare("SELECT * FROM room;");
        $RoomDB_Query->execute();
        return $RoomDB_Query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database Error:" . $e->getMessage()); // Log error for debugging
        return []; // Return an empty array instead of killing the script
    }
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["action"])) {
    $action = $_POST["action"];
    $redirectPage = "../index.php?page=ManageDB";

    try {
        if ($action === "add_building") {
            $stmt = $pdo->prepare("INSERT INTO BUILDING (BLDG_CODE, BLDG_NAME, BLDG_LOCATION) VALUES (?, ?, ?)");
            $stmt->execute([$_POST["bldg_code"], $_POST["bldg_name"], $_POST["bldg_location"]]);
            $redirectPage .= "&subpage=Building";

        } elseif ($action === "edit_building") {
            $stmt = $pdo->prepare("UPDATE BUILDING SET BLDG_NAME=?, BLDG_LOCATION=? WHERE BLDG_CODE=?");
            $stmt->execute([$_POST["bldg_name"], $_POST["bldg_location"], $_POST["bldg_code"]]);
            $redirectPage .= "&subpage=Building";

        } elseif ($action === "add_room") {
            $stmt = $pdo->prepare("INSERT INTO ROOM (ROOM_CODE, ROOM_TYPE, BLDG_CODE) VALUES (?, ?, ?)");
            $stmt->execute([$_POST["room_code"], $_POST["room_type"], $_POST["bldg_code"]]);
            $redirectPage .= "&subpage=RoomDB";

        } elseif ($action === "edit_room") {
            $stmt = $pdo->prepare("UPDATE ROOM SET ROOM_TYPE=?, BLDG_CODE=? WHERE ROOM_CODE=?");
            $stmt->execute([$_POST["room_type"], $_POST["bldg_code"], $_POST["room_code"]]);
            $redirectPage .= "&subpage=RoomDB";

        } elseif ($action === "add_school") {
            $stmt = $pdo->prepare("INSERT INTO SCHOOL (SCHOOL_CODE, SCHOOL_NAME, PROF_NUM) VALUES (?, ?, ?)");
            $stmt->execute([$_POST["school_code"], $_POST["school_name"], $_POST["prof_num"]]);
            $redirectPage .= "&subpage=SchoolDB";

        } elseif ($action === "edit_school") {
            $stmt = $pdo->prepare("UPDATE SCHOOL SET SCHOOL_NAME=?, PROF_NUM=? WHERE SCHOOL_CODE=?");
            $stmt->execute([$_POST["school_name"], $_POST["prof_num"], $_POST["school_code"]]);
            $redirectPage .= "&subpage=SchoolDB";

        } elseif ($action === "add_department") {
            $stmt = $pdo->prepare("INSERT INTO DEPARTMENT (DEPT_CODE, DEPT_NAME, SCHOOL_CODE, PROF_NUM) VALUES (?, ?, ?, ?)");
            $stmt->execute([$_POST["dept_code"], $_POST["dept_name"], $_POST["school_code"], $_POST["prof_num"]]);
            $redirectPage .= "&subpage=DepartmentDB";

        } elseif ($action === "edit_department") {
            $stmt = $pdo->prepare("UPDATE DEPARTMENT SET DEPT_NAME=?, SCHOOL_CODE=?, PROF_NUM=? WHERE DEPT_CODE=?");
            $stmt->execute([$_POST["dept_name"], $_POST["school_code"], $_POST["prof_num"], $_POST["dept_code"]]);
            $redirectPage .= "&subpage=DepartmentDB";

        } elseif ($action === "add_semester") {
            $stmt = $pdo->prepare("INSERT INTO SEMESTER (SEMESTER_CODE, SEMESTER_YEAR, SEMESTER_TERM, SEMESTER_START_DATE, SEMESTER_END_DATE) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_POST["semester_code"], $_POST["semester_year"], $_POST["semester_term"], $_POST["semester_start_date"], $_POST["semester_end_date"]]);
            $redirectPage .= "&subpage=SemesterDB";

        } elseif ($action === "edit_semester") {
            $stmt = $pdo->prepare("UPDATE SEMESTER SET SEMESTER_YEAR=?, SEMESTER_TERM=?, SEMESTER_START_DATE=?, SEMESTER_END_DATE=? WHERE SEMESTER_CODE=?");
            $stmt->execute([$_POST["semester_year"], $_POST["semester_term"], $_POST["semester_start_date"], $_POST["semester_end_date"], $_POST["semester_code"]]);
            $redirectPage .= "&subpage=SemesterDB";

        } elseif ($action === "add_class") {
            $stmt = $pdo->prepare("INSERT INTO CLASS (CLASS_CODE, CLASS_SECTION, CLASS_TIME, CRS_CODE, PROF_NUM, SEMESTER_CODE) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $_POST["class_code"],
                $_POST["class_section"],
                $_POST["class_time"],
                $_POST["crs_code"],
                $_POST["prof_num"],
                $_POST["semester_code"]
            ]);
            $redirectPage .= "&subpage=ClassDB";

        } elseif ($action === "edit_class") {
            $stmt = $pdo->prepare("UPDATE CLASS SET CLASS_SECTION=?, CLASS_TIME=?, CRS_CODE=?, PROF_NUM=?, SEMESTER_CODE=? WHERE CLASS_CODE=?");
            $stmt->execute([
                $_POST["class_section"],
                $_POST["class_time"],
                $_POST["crs_code"],
                $_POST["prof_num"],
                $_POST["semester_code"],
                $_POST["class_code"]
            ]);
            $redirectPage .= "&subpage=ClassDB";
            } elseif ($action === "add_course") { // Add Course
                $stmt = $pdo->prepare("INSERT INTO COURSE (CRS_CODE, CRS_TITLE, CRS_DESCRIPTION, CRS_CREDIT) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_POST["crs_code"], $_POST["crs_title"], $_POST["crs_description"], $_POST["crs_credit"]]);
                $redirectPage .= "&subpage=CourseDB";

            } elseif ($action === "edit_course") { // Edit Course
                $stmt = $pdo->prepare("UPDATE COURSE SET CRS_TITLE=?, CRS_DESCRIPTION=?, CRS_CREDIT=? WHERE CRS_CODE=?");
                $stmt->execute([$_POST["crs_title"], $_POST["crs_description"], $_POST["crs_credit"], $_POST["crs_code"]]);
                $redirectPage .= "&subpage=CourseDB";
            }
            if ($action === "add_professor") {
                $stmt = $pdo->prepare("INSERT INTO PROFESSOR (PROF_NUM, PROF_SPECIALTY, PROF_RANK, PROF_LNAME, PROF_FNAME, PROF_INITIAL, PROF_EMAIL) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST["prof_num"],
                    $_POST["prof_specialty"],
                    $_POST["prof_rank"],
                    $_POST["prof_lname"],
                    $_POST["prof_fname"],
                    $_POST["prof_initial"],
                    $_POST["prof_email"]
                ]);
                $redirectPage .= "&subpage=ProfDB";
    
            } elseif ($action === "edit_professor") {
                $stmt = $pdo->prepare("UPDATE PROFESSOR SET 
                                       PROF_SPECIALTY=?, PROF_RANK=?, PROF_LNAME=?, PROF_FNAME=?, PROF_INITIAL=?, PROF_EMAIL=?
                                       WHERE PROF_NUM=?");
                $stmt->execute([
                    $_POST["prof_specialty"],
                    $_POST["prof_rank"],
                    $_POST["prof_lname"],
                    $_POST["prof_fname"],
                    $_POST["prof_initial"],
                    $_POST["prof_email"],
                    $_POST["prof_num"]
                ]);
                $redirectPage .= "&subpage=ProfDB";
            }
            elseif ($action === "add_student") {
                $stmt = $pdo->prepare("INSERT INTO STUDENT (STU_NUM, DEPT_CODE, STU_LNAME, STU_FNAME, STU_INITIAL, STU_EMAIL, PROF_NUM) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([
                    $_POST["stu_num"],
                    $_POST["dept_code"],
                    $_POST["stu_lname"],
                    $_POST["stu_fname"],
                    $_POST["stu_initial"],
                    $_POST["stu_email"],
                    $_POST["prof_num"]
                ]);
                $redirectPage .= "&subpage=StudentDB";
    
            } elseif ($action === "edit_student") {
                $stmt = $pdo->prepare("UPDATE STUDENT SET 
                                       DEPT_CODE=?, STU_LNAME=?, STU_FNAME=?, STU_INITIAL=?, STU_EMAIL=?, PROF_NUM=?
                                       WHERE STU_NUM=?");
                $stmt->execute([
                    $_POST["dept_code"],
                    $_POST["stu_lname"],
                    $_POST["stu_fname"],
                    $_POST["stu_initial"],
                    $_POST["stu_email"],
                    $_POST["prof_num"],
                    $_POST["stu_num"]
                ]);
                $redirectPage .= "&subpage=StudentDB";
            }
             elseif ($action === "add_enrollment") {
                $stmt = $pdo->prepare("INSERT INTO enroll (CLASS_CODE, STU_NUM, ENROLL_DATE, ENROLL_GRADE) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_POST["class_code"], $_POST["stu_num"], $_POST["enroll_date"], $_POST["enroll_grade"]]);
                $redirectPage .= "&subpage=EnrollmentDB";

            } elseif ($action === "edit_enrollment") {
                $stmt = $pdo->prepare("UPDATE enroll SET ENROLL_DATE=?, ENROLL_GRADE=? WHERE CLASS_CODE=? AND STU_NUM=?");
                $stmt->execute([$_POST["enroll_date"], $_POST["enroll_grade"], $_POST["class_code"], $_POST["stu_num"]]);
                $redirectPage .= "&subpage=EnrollmentDB";
            }

        // Redirect once at the end
        header("Location: $redirectPage");
        exit;
    } catch (PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
    }
}




if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["action"], $_GET["id"], $_GET["subpage"])) {
    $id = $_GET["id"];
    $subpage = $_GET["subpage"];
    try {
        if ($_GET["action"] === "delete") {
            switch ($subpage) {
                case "RoomDB":
                    $stmt = $pdo->prepare("DELETE FROM ROOM WHERE ROOM_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=RoomDB";
                    break;
                    
                case "Building":
                    $stmt = $pdo->prepare("DELETE FROM BUILDING WHERE BLDG_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=Building";
                    break;
                    
                case "ClassDB":
                    $stmt = $pdo->prepare("DELETE FROM CLASS WHERE CLASS_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=ClassDB";
                    break;
                    
                case "CourseDB":
                    $stmt = $pdo->prepare("DELETE FROM COURSE WHERE CRS_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=CourseDB";
                    break;
                    
                case "DepartmentDB":
                    $stmt = $pdo->prepare("DELETE FROM DEPARTMENT WHERE DEPT_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=DepartmentDB";
                    break;
                    
                case "EnrollmentDB":
                    $stmt = $pdo->prepare("DELETE FROM enroll WHERE CLASS_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=EnrollmentDB";
                    break;
                    
                case "ProfDB":
                    $stmt = $pdo->prepare("DELETE FROM PROFESSOR WHERE PROF_NUM = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=ProfDB";
                    break;
                    
                case "SchoolDB":
                    $stmt = $pdo->prepare("DELETE FROM SCHOOL WHERE SCHOOL_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=SchoolDB";
                    break;
                    
                case "SemesterDB":
                    $stmt = $pdo->prepare("DELETE FROM SEMESTER WHERE SEMESTER_CODE = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=SemesterDB";
                    break;
                    
                case "StudentDB":
                    $stmt = $pdo->prepare("DELETE FROM STUDENT WHERE STU_NUM = ?");
                    $stmt->execute([$id]);
                    $redirectPage = "index.php?page=ManageDB&subpage=StudentDB";
                    break;
                    
                default:
                    die("Invalid subpage: " . htmlspecialchars($subpage)); // Debugging
            }
            
            // Ensure no output before header() is sent
            ob_clean();
            header("Location: $redirectPage");
            exit;
        } elseif ($_GET["action"] === "delete_building") {
            // Handle the special case for delete_building
            $stmt = $pdo->prepare("DELETE FROM BUILDING WHERE BLDG_CODE = ?");
            $stmt->execute([$id]);
            $redirectPage = "index.php?page=ManageDB&subpage=Building";
            
            ob_clean();
            header("Location: $redirectPage");
            exit;
        }
    } catch (PDOException $e) {
        // Check for foreign key constraint violations
        if (strpos($e->getMessage(), 'foreign key constraint fails') !== false) {
            die("Cannot delete this record because it is being used in other tables. Please remove related records first.");
        } else {
            die("Database Error: " . $e->getMessage()); // Show error for debugging
        }
    }
}

?>