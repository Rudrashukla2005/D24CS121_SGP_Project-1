<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM faculty WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $faculty = $stmt->fetch();
    } else {
        echo "Faculty not found.";
        exit;
    }
} else {
    echo "Invalid faculty ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Body Background */
        body {
            background-color: #333533; 
            font-family: 'Roboto', sans-serif; 
            color: #ffffff; 
        }

        /* Main Container */
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 40px;
            background-color: #242423; 
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            position: relative; /* Position relative of button */
        }

        /* Profile Photo */
        .profile-photo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .profile-photo img {
            border-radius: 50%;
            width: 220px; /* Increased size */
            height: 220px; 
            object-fit: cover;
        }

        h2 {
            text-align: center;
            color: #ffffff; 
            margin-bottom: 20px;
        }

        h5 {
            font-size: 1.5em;
            font-weight: 700; 
            padding: 10px; 
            margin: 10px 0;
            background-color: #4a4a4a; 
            color: #ffffff; 
            border-radius: 5px;
            text-align: center;
            margin-bottom: 15px;
            font-style: normal; 
        }

        /* Info Sections */
        .info-sections {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .personal-details,
        .professional-details,
        .download-section {
            flex: 1;
            padding: 20px;
            border-radius: 8px;
            background-color: #333533; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .download-section {
            margin-top: 10px;
        }

        /* Layout for Larger Screens */
        @media (min-width: 768px) {
            .info-sections {
                flex-direction: row;
                justify-content: space-between;
                gap: 20px;
            }
        }

        /* Text Alignment */
        p,
        h5 {
            margin:  10px 0;
            text-align: justify;
            color: #ffffff; 
        }

        /* Buttons Styling */
        .btn-download,
        .btn-back {
            display: inline-block; /* inline-block for side-by-side alignment */
            padding: 10px 20px;
            margin: 10px; /* Margin for spacing */
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            color: #000000; 
            background-color: #f5cb5c; 
            text-decoration: none; 
        }

        .btn-download:hover,
        .btn-back:hover {
            background-color: #e0b84a; 
            color: #000000; 
            text-decoration: none; 
        }

        .btn-danger {
            background-color: #ff4d4d; 
            color: #ffffff; 
            padding: 10px 20px;
            margin: 10px; 
            font-size: 16px;
            text-align: center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none; 
        }

        .btn-danger:hover {
            background-color: #e60000; 
            color: #ffffff; 
            text-decoration: none; 
        }

        /* Centered Delete Button */
        .delete-faculty {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="profile-photo">
            <img src="data:image/jpeg;base64,<?php echo base64_encode($faculty['profile_photo']); ?>" alt="Profile Photo">
        </div>

        <h2>
            <strong><?php echo htmlspecialchars($faculty['first_name']) . ' ' . htmlspecialchars($faculty['last_name']); ?></strong>
        </h2>

        <div class="info-sections">
    <!-- Personal Details -->
    <div class="personal-details">
        <h5>Personal Details</h5>
        <p><strong>Name:</strong> <?php echo htmlspecialchars($faculty['first_name']) . ' ' . htmlspecialchars($faculty['middle_name']) . ' ' . htmlspecialchars($faculty['last_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($faculty['email']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($faculty['contact_number']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($faculty['address']); ?></p>
        <p><strong>Permanent Address:</strong> <?php echo htmlspecialchars($faculty['permanent_address']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($faculty['dob']); ?></p>
        <p><strong>Birth City:</strong> <?php echo htmlspecialchars($faculty['birth_city']); ?></p>
        <p><strong>Birth State:</strong> <?php echo htmlspecialchars($faculty['birth_state']); ?></p>
        <p><strong>Aadhar Number:</strong> <?php echo htmlspecialchars($faculty['adhaar_number']); ?></p>
        <p><strong>PAN Number:</strong> <?php echo htmlspecialchars($faculty['PAN_number']); ?></p>
        <p><strong>Passport Number:</strong> <?php echo htmlspecialchars($faculty['passport_number']); ?></p>
        <p><strong>Passport Issue Date:</strong> <?php echo htmlspecialchars($faculty['passport_issue_date']); ?></p>
        <p><strong>Passport Expiry Date:</strong> <?php echo htmlspecialchars($faculty['passport_expiry_date']); ?></p>
        <p><strong>Current City:</strong> <?php echo htmlspecialchars($faculty['city']); ?></p>
        <p><strong>Current State:</strong> <?php echo htmlspecialchars($faculty['state']); ?></p>
        <p><strong>Nationality:</strong> <?php echo htmlspecialchars($faculty['nationality']); ?></p>
        <p><strong>Mother Tongue:</strong> <?php echo htmlspecialchars($faculty['mother_tongue']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($faculty['gender']); ?></p>
        <p><strong>Marital Status:</strong> <?php echo htmlspecialchars($faculty['marital_status']); ?></p>
        <p><strong>Caste Category:</strong> <?php echo htmlspecialchars($faculty['caste_category']); ?></p>
        <p><strong>Subcaste Category:</strong> <?php echo htmlspecialchars($faculty['subcaste_category']); ?></p>
        <p><strong>Blood Group:</strong> <?php echo htmlspecialchars($faculty['blood_group']); ?></p>
        <p><strong>Hobbies:</strong> <?php echo htmlspecialchars($faculty['hobbies']); ?></p>
        <p><strong>Skill Set:</strong> <?php echo htmlspecialchars($faculty['skill_set']); ?></p>
        <p><strong>Strength:</strong> <?php echo htmlspecialchars($faculty['strength']); ?></p>
        <p><strong>Weakness:</strong> <?php echo htmlspecialchars($faculty['weakness']); ?></p>
        <p><strong>Height:</strong> <?php echo htmlspecialchars($faculty['height']); ?> cm</p>
        <p><strong>Weight:</strong> <?php echo htmlspecialchars($faculty['weight']); ?> kg</p>
    </div>

    <!-- Professional Details -->
    <div class="professional-details">
        <h5>Professional Details</h5>
        <p><strong>Education:</strong> <?php echo htmlspecialchars($faculty['education']); ?></p>
        <p><strong>SSC Percentage:</strong> <?php echo htmlspecialchars($faculty['ssc_percentage']); ?>%</p>
        <p><strong>HSC Percentage:</strong> <?php echo htmlspecialchars($faculty['hsc_percentage']); ?>%</p>
        <p><strong>Past Job Name:</strong> <?php echo htmlspecialchars($faculty['past_job_name']); ?></p>
        <p><strong>Past Job Address:</strong> <?php echo htmlspecialchars($faculty['past_job_address']); ?></p>
        <p><strong>Experience Before Joining:</strong> <?php echo htmlspecialchars($faculty['experience_before_joining']); ?> years</p>
        <p><strong>Employee ID:</strong> <?php echo htmlspecialchars($faculty['employee_id']); ?></p>
        <p><strong>Status:</strong> <?php echo htmlspecialchars($faculty['status']); ?></p>
        <p><strong>Abbreviation:</strong> <?php echo htmlspecialchars($faculty['abbreviation']); ?></p>
        <p><strong>Date of Joining:</strong> <?php echo htmlspecialchars($faculty['date_of_joining']); ?></p>
        <p><strong>Increment Month:</strong> <?php echo htmlspecialchars($faculty['increment_month']); ?></p>
        <p><strong>Organization:</strong> <?php echo htmlspecialchars($faculty['organization']); ?></p>
        <p><strong>Sub Organization:</strong> <?php echo htmlspecialchars($faculty['sub_organization']); ?></p>
        <p><strong>Department:</strong> <?php echo htmlspecialchars($faculty['department']); ?></p>
        <p><strong>Functional Department:</strong> <?php echo htmlspecialchars($faculty['functional_department']); ?></p>
        <p><strong>Employee Category:</strong> <?php echo htmlspecialchars($faculty['employee_category']); ?></p>
        <p><strong>Designation:</strong> <?php echo htmlspecialchars($faculty['designation']); ?></p>
        <p><strong>Pay Grade:</strong> <?php echo htmlspecialchars($faculty['pay_grade']); ?></p>
        <p><strong>Gross Salary:</strong> <?php echo htmlspecialchars($faculty['gross_salary']); ?> INR</p>
    </div>
</div>


        <!-- Download Section -->
        <div class="download-section">
            <h5>Document Section</h5>
            <a href="download_pdf.php?file=ssc_marksheet&id=<?php echo $faculty['id']; ?>" class="btn-download">Download SSC Marksheet</a>
            <a href="download_pdf.php?file=hsc_marksheet&id=<?php echo $faculty['id']; ?>" class="btn-download">Download HSC Marksheet</a>
            <a href="download_pdf.php?file=experience_letter&id=<?php echo $faculty['id']; ?>" class="btn-download">Download Experience Letter</a>
            <!--NEW ADDED FILES DOWNLOAD INFORMATION-->
            <a href="download_pdf.php?file=DEGREE_MARKSHEET&id=<?php echo $faculty['id']; ?>" class="btn-download">Download DEGREE Marksheet</a>
            <a href="download_pdf.php?file=DEGREE_CERTIFICATE&id=<?php echo $faculty['id']; ?>" class="btn-download">Download DEGREE Certificate</a>
            <a href="download_pdf.php?file=PAN_CARD&id=<?php echo $faculty['id']; ?>" class="btn-download">Download PAN CARD</a>
            <a href="download_pdf.php?file=AADHAR_CARD&id=<?php echo $faculty['id']; ?>" class="btn-download">Download AADHAR CARD</a>
        </div>

        <!-- Buttons Section -->
        <div class="button-section" style="text-align: center; margin-top: 20px;">
            <a href="index.php" class="btn-back">Back to Home</a>
            <form action="delete_faculty.php" method="GET" onsubmit="return confirm('Are you sure you want to delete this faculty member?');" style="display: inline;">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($faculty['id']); ?>">
                <button type="submit" class="btn-danger"> Delete Faculty</button>
            </form>
        </div>
    </div>
</body>
</html>