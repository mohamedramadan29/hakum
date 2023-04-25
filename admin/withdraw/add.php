 <?php if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['add_car'])) {
     
            $course_name = filter_var(
                $_POST['course_name'],
                FILTER_SANITIZE_STRING
            );
            $course_name_en = filter_var(
                $_POST['course_name_en'],
                FILTER_SANITIZE_STRING
            );
            $course_degree = filter_var(
                $_POST['course_degree'],
                FILTER_SANITIZE_STRING
            );
            $course_intake = filter_var(
                $_POST['course_intake'],
                FILTER_SANITIZE_STRING
            );
            $spe_id = filter_var(
                $_POST['spe_id'],
                FILTER_SANITIZE_STRING
            );
            
            $uni_id = filter_var(
                $_POST['uni_id'],
                FILTER_SANITIZE_STRING
            );

            /// More Validation To Show Error
            $formerror = [];
            if (empty($course_name)) {
                $formerror[] = 'Please Insert Name';
            }
            foreach ($formerror as $errors) {
                echo "<div class='alert alert-danger danger_message'>" .
                    $errors .
                    '</div>';
            }

            if (empty($formerror)) {
                $stmt = $connect->prepare("INSERT INTO course (course_name,course_name_en,
                course_degree,course_intake,spe_id,uni_id)
                VALUES (:zname,:zname_en,:zdegree,:zintake,:zspe_id,:zuni_id)");
                $stmt->execute([
                    'zname' => $course_name,
                    'zname_en' => $course_name_en,
                    'zdegree' => $course_degree,
                    'zintake' => $course_intake,
                    'zspe_id' => $spe_id,
                    'zuni_id' => $uni_id,
                ]);
                if ($stmt) { ?>
                 <div class="alert-success ">
                     تم اضافة كورس جديد بنجاح
                     <?php // header('refresh:3;url=main.php?dir=city&page=report'); 
                        ?>
                 </div>

 <?php }
            }
        }
    }
