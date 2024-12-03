<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $errors = [];
    $profilePhotoData = null;
    $sscMarksheetData = null;
    $hscMarksheetData = null;
    $experienceLetterData = null;

    // Profile photo handling
    $profilePhoto = $_FILES["profilePhoto"]["tmp_name"];
    $profilePhotoType = $_FILES["profilePhoto"]["type"];

    if (substr($profilePhotoType, 0, 5) === "image") {
        $profilePhotoData = file_get_contents($profilePhoto);
    } else {
        $errors[] = "Invalid Profile Photo file type. Please upload an image.";
    }

    // SSC Marksheet handling
    $sscMarksheet = $_FILES["sscMarksheet"]["tmp_name"];
    $sscMarksheetType = $_FILES["sscMarksheet"]["type"];

    if ($sscMarksheetType === "application/pdf" || $sscMarksheetType === "application/octet-stream") {
        $sscMarksheetData = file_get_contents($sscMarksheet);
    } else {
        $errors[] = "Invalid SSC Marksheet file type. Please upload a PDF.";
    }

    // HSC Marksheet handling
    $hscMarksheet = $_FILES["hscMarksheet"]["tmp_name"];
    $hscMarksheetType = $_FILES["hscMarksheet"]["type"];

    if ($hscMarksheetType === "application/pdf" || $hscMarksheetType === "application/octet-stream") {
        $hscMarksheetData = file_get_contents($hscMarksheet);
    } else {
        $errors[] = "Invalid HSC Marksheet file type. Please upload a PDF.";
    }

    // Experience Letter handling
    if (isset($_FILES["experienceLetter"]) && $_FILES["experienceLetter"]["error"] === UPLOAD_ERR_OK) {
        $experienceLetter = $_FILES["experienceLetter"]["tmp_name"];
        $experienceLetterType = $_FILES["experienceLetter"]["type"];

        if ($experienceLetterType === "application/pdf" || $experienceLetterType === "application/octet-stream") {
            $experienceLetterData = file_get_contents($experienceLetter);
        } else {
            $errors[] = "Invalid Experience Letter file type. Please upload a PDF.";
        }
    }
        // ALL READING DETAILS OF PAN CARD FILE 
    $panCard = $_FILES["PAN_CARD"]["tmp_name"];
$panCardType = $_FILES["PAN_CARD"]["type"];

if ($panCardType === "application/pdf" || $panCardType === "application/octet-stream") {
    $panCardData = file_get_contents($panCard);
} else {
    $errors[] = "Invalid PAN Card file type. Please upload a PDF.";
}

// Reading the Aadhar card file
$aadharCard = $_FILES["AADHAR_CARD"]["tmp_name"];
$aadharCardType = $_FILES["AADHAR_CARD"]["type"];

if ($aadharCardType === "application/pdf" || $aadharCardType === "application/octet-stream") {
    $aadharCardData = file_get_contents($aadharCard);
} else {
    $errors[] = "Invalid Aadhar Card file type. Please upload a PDF.";
}

// Reading the Degree certificate file
$degreeCertificate = $_FILES["DEGREE_CERTIFICATE"]["tmp_name"];
$degreeCertificateType = $_FILES["DEGREE_CERTIFICATE"]["type"];

if ($degreeCertificateType === "application/pdf" || $degreeCertificateType === "application/octet-stream") {
    $degreeCertificateData = file_get_contents($degreeCertificate);
} else {
    $errors[] = "Invalid Degree Certificate file type. Please upload a PDF.";
}

// Reading the Degree marksheet file
$degreeMarksheet = $_FILES["DEGREE_MARKSHEET"]["tmp_name"];
$degreeMarksheetType = $_FILES["DEGREE_MARKSHEET"]["type"];

if ($degreeMarksheetType === "application/pdf" || $degreeMarksheetType === "application/octet-stream") {
    $degreeMarksheetData = file_get_contents($degreeMarksheet);
} else {
    $errors[] = "Invalid Degree Marksheet file type. Please upload a PDF.";
}

    // Execute if there are no errors
    if (empty($errors)) {
        $sql =  "INSERT INTO faculty (profile_photo, ssc_marksheet, hsc_marksheet, experience_letter, 
        PAN_CARD, AADHAR_CARD, DEGREE_CERTIFICATE, DEGREE_MARKSHEET, first_name, last_name, middle_name, 
        dob, birth_city, birth_state, adhaar_number, contact_number, email, address, city, state, permanent_address, 
        nationality, mother_tongue, gender, marital_status, caste_category, subcaste_category, blood_group, hobbies, 
        skill_set, strength, weakness, pan_number, passport_number, passport_issue_date, passport_expiry_date, 
        height, weight, education, ssc_percentage, hsc_percentage, past_job_name, past_job_address, experience_before_joining, 
        employee_id, status, abbreviation, date_of_joining, increment_month, organization, sub_organization, 
        department, functional_department, employee_category, designation, pay_grade, gross_salary)
    VALUES (:profile_photo, :ssc_marksheet, :hsc_marksheet, :experience_letter, 
        :PAN_CARD, :AADHAR_CARD, :DEGREE_CERTIFICATE, :DEGREE_MARKSHEET, :first_name, :last_name, :middle_name, 
        :dob, :birth_city, :birth_state, :adhaar_number, :contact_number, :email, :address, :city, :state, 
        :permanent_address, :nationality, :mother_tongue, :gender, :marital_status, :caste_category, :subcaste_category, 
        :blood_group, :hobbies, :skill_set, :strength, :weakness, :pan_number, :passport_number, :passport_issue_date, 
        :passport_expiry_date, :height, :weight, :education, :ssc_percentage, :hsc_percentage, :past_job_name, 
        :past_job_address, :experience_before_joining, :employee_id, :status, :abbreviation, :date_of_joining, 
        :increment_month, :organization, :sub_organization, :department, :functional_department, :employee_category, 
        :designation, :pay_grade, :gross_salary)";

        $stmt = $conn->prepare($sql);

        // Binding parameters for files
        $stmt->bindParam(':profile_photo', $profilePhotoData, PDO::PARAM_LOB);
        $stmt->bindParam(':ssc_marksheet', $sscMarksheetData, PDO::PARAM_LOB);
        $stmt->bindParam(':hsc_marksheet', $hscMarksheetData, PDO::PARAM_LOB);
        $stmt->bindParam(':experience_letter', $experienceLetterData, PDO::PARAM_LOB);
             // Bind the new file fields with PDO::PARAM_LOB for binary data
             $stmt->bindParam(':PAN_CARD', $panCardData, PDO::PARAM_LOB);
             $stmt->bindParam(':AADHAR_CARD', $aadharCardData, PDO::PARAM_LOB);
             $stmt->bindParam(':DEGREE_CERTIFICATE', $degreeCertificateData, PDO::PARAM_LOB);
             $stmt->bindParam(':DEGREE_MARKSHEET', $degreeMarksheetData, PDO::PARAM_LOB);


        // Binding parameters for form data
        $stmt->bindParam(':first_name', $_POST["firstName"]);
        $stmt->bindParam(':last_name', $_POST["lastName"]);
        $stmt->bindParam(':middle_name', $_POST["middleName"]);
        $stmt->bindParam(':dob', $_POST["dob"]);
        $stmt->bindParam(':birth_city', $_POST["birthCity"]);
        $stmt->bindParam(':birth_state', $_POST["birthState"]);
        $stmt->bindParam(':adhaar_number', $_POST["adhaarNumber"]);
        $stmt->bindParam(':contact_number', $_POST["contactNumber"]);
        $stmt->bindParam(':email', $_POST["email"]);
        $stmt->bindParam(':address', $_POST["address"]);
        $stmt->bindParam(':city', $_POST["city"]);
        $stmt->bindParam(':state', $_POST["state"]);
        $stmt->bindParam(':education', $_POST["education"]);
        $stmt->bindParam(':ssc_percentage', $_POST["sscPercentage"]);
        $stmt->bindParam(':hsc_percentage', $_POST["hscPercentage"]);
        $stmt->bindParam(':past_job_name', $_POST["pastJobName"]);
        $stmt->bindParam(':past_job_address', $_POST["pastJobAddress"]);

        // Additional fields from personal details
        $stmt->bindParam(':permanent_address', $_POST["permanentAddress"]);
        $stmt->bindParam(':nationality', $_POST["nationality"]);
        $stmt->bindParam(':mother_tongue', $_POST["motherTongue"]);
        $stmt->bindParam(':gender', $_POST["gender"]);
        $stmt->bindParam(':marital_status', $_POST["maritalStatus"]);
        $stmt->bindParam(':caste_category', $_POST["casteCategory"]);
        $stmt->bindParam(':subcaste_category', $_POST["subCasteCategory"]);
        $stmt->bindParam(':blood_group', $_POST["bloodGroup"]);
        $stmt->bindParam(':hobbies', $_POST["hobbies"]);
        $stmt->bindParam(':skill_set', $_POST["skillSet"]);
        $stmt->bindParam(':strength', $_POST["strength"]);
        $stmt->bindParam(':weakness', $_POST["weakness"]);
        $stmt->bindParam(':pan_number', $_POST["panNumber"]);
        $stmt->bindParam(':passport_number', $_POST["passportNumber"]);
        $stmt->bindParam(':passport_issue_date', $_POST["passportIssueDate"]);
        $stmt->bindParam(':passport_expiry_date', $_POST["passportExpiryDate"]);
        $stmt->bindParam(':height', $_POST["height"]);
        $stmt->bindParam(':weight', $_POST["weight"]);

        // Additional fields from professional details
        $stmt->bindParam(':experience_before_joining', $_POST["experienceBeforeJoining"]);
        $stmt->bindParam(':employee_id', $_POST["employeeId"]);
        $stmt->bindParam(':status', $_POST["status"]);
        $stmt->bindParam(':abbreviation', $_POST["abbreviation"]);
        $stmt->bindParam(':date_of_joining', $_POST["dateOfJoining"]);
        $stmt->bindParam(':increment_month', $_POST["incrementMonth"]);
        $stmt->bindParam(':organization', $_POST["organization"]);
        $stmt->bindParam(':sub_organization', $_POST["subOrganization"]);
        $stmt->bindParam(':department', $_POST["department"]);
        $stmt->bindParam(':functional_department', $_POST["functionalDepartment"]);
        $stmt->bindParam(':employee_category', $_POST["employeeCategory"]);
        $stmt->bindParam(':designation', $_POST["designation"]);
        $stmt->bindParam(':pay_grade', $_POST["payGrade"]);
        $stmt->bindParam(':gross_salary', $_POST["grossSalary"]);

            // all the mentioned details are fulfilled hereby...

        if ($stmt->execute()) {
            $_SESSION['add'] = 'true';
            header("Location: FacultyForm.html");
            exit();
        }
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }
}
?>
