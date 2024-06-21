<?php include("header.php"); ?>

<div class="container">
    <h2 class="text-center" style="margin-bottom: 50px;">Members</h2>
    <div class="row">
        <?php
        // Assuming you have an array of members, you can replace this with a database query if needed
        $members = [
            [
                "name" => "Jaylin D. Fernandez",
                "age" => 20,
                "course" => "BS Information Technology",
                "profile_link" => "jaylin_pwp.php",
                "picture" => "jaylin.jpg",
                "contact_info" => "jaylinfernandez03@gmail.com"
            ],
            [
                "name" => "Femalyn Darantan",
                "age" => 19,
                "course" => "BS Information Technology",
                "profile_link" => "femalyn_pwp.php",
                "picture" => "femalyn.jpg",
                "contact_info" => "femalyndarantan@gmail.com"
            ],
            [
                "name" => "April Rose Meneses",
                "age" => 20,
                "course" => "BS Information Technology",
                "profile_link" => "april_pwp.php",
                "picture" => "april.jpg",
                "contact_info" => "aprilrosemeneses@gmail.com"
            ],
        ];

        foreach ($members as $member) {
            echo "<div class='col-md-4 text-center'>
                    <img src='" . htmlspecialchars($member['picture']) . "' alt='" . htmlspecialchars($member['name']) . "' class='img-circle'>
                    <p><strong>Name:</strong> " . htmlspecialchars($member['name']) . "</p>
                    <p><strong>Age:</strong> " . htmlspecialchars($member['age']) . "</p>
                    <p><strong>Course:</strong> " . htmlspecialchars($member['course']) . "</p>
                    <p><strong>Contact Info:</strong> " . htmlspecialchars($member['contact_info']) . "</p>
                    <p><a href='" . htmlspecialchars($member['profile_link']) . "' class='btn btn-info'>View Profile</a></p>
                </div>";
        }
        ?>
    </div>
</div>
<div>
            <div style="margin-top: 100px;">     
    <a href="homepage.php" class="btn btn-secondary">Back</a>
       </div>

<?php include("footer.php"); ?>

<style>
    .container {
        margin-top: 50px;
    }
    .text-center {
        text-align: center;
    }
    .img-circle {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 30px;
    }
    .btn-info {
        background-color: #5bc0de;
        border-color: #46b8da;
    }
    .btn-info:hover {
        background-color: #31b0d5;
        border-color: #269abc;
    }
    .col-md-4 {
        margin-bottom: 30px;
    }
</style>
