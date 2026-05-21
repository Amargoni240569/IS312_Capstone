<?php
include '../config/db.php';

$pageTitle = "Contact";

include "../admin/header.php";

$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullName = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = $_POST['subject'] ?? 'Website contact message';
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("
        INSERT INTO contact_messages(full_name, email, subject, message, status)
        VALUES (?, ?, ?, ?, 'pending')
    ");

    $stmt->bind_param("ssss", $fullName, $email, $subject, $message);
    $stmt->execute();
    $stmt->close();

    $success = "Message sent successfully!";
}
?>

<style>
.contact-page{
    width:100%;
    min-height:100vh;
    padding:60px 8%;
    background:#f5efe6;
}
.contact-header{
    text-align:center;
    margin-bottom:50px;
}
.contact-header h1{
    font-size:42px;
    color:#8b4513;
    margin-bottom:12px;
}
.contact-header p{
    font-size:18px;
    color:#555;
}
.contact-info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit, minmax(220px,1fr));
    gap:25px;
    margin-bottom:60px;
}
.contact-card{
    background:#fff;
    border-radius:20px;
    padding:30px;
    text-align:center;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
}
.contact-card h3{
    color:#8b4513;
    margin-bottom:15px;
    font-size:22px;
}
.contact-card p{
    color:#555;
    line-height:1.7;
    font-size:16px;
}
.contact-form-wrapper{
    max-width:850px;
    margin:auto;
    background:#fff;
    padding:45px;
    border-radius:25px;
    box-shadow:0 10px 30px rgba(0,0,0,0.08);
}
.contact-form-wrapper h2{
    text-align:center;
    color:#8b4513;
    margin-bottom:10px;
    font-size:34px;
}
.contact-form-wrapper p{
    text-align:center;
    color:#666;
    margin-bottom:35px;
}
.success-msg{
    background:#d4edda;
    color:#155724;
    padding:15px;
    border-radius:12px;
    margin-bottom:25px;
    text-align:center;
    font-weight:bold;
}
.contact-form{
    display:flex;
    flex-direction:column;
    gap:22px;
}
.form-group{
    display:flex;
    flex-direction:column;
}
.form-group label{
    margin-bottom:8px;
    font-weight:bold;
    color:#444;
}
.contact-form input,
.contact-form textarea{
    padding:14px 16px;
    border-radius:12px;
    border:1px solid #ddd;
    font-size:16px;
    background:#fff;
}
.contact-form textarea{
    min-height:160px;
    resize:vertical;
}
.submit-btn{
    background:#c97b4b;
    color:#fff;
    border:none;
    padding:15px;
    border-radius:12px;
    font-size:17px;
    font-weight:bold;
    cursor:pointer;
}
@media(max-width:768px){
    .contact-page{
        padding:40px 5%;
    }
    .contact-header h1{
        font-size:32px;
    }
    .contact-form-wrapper{
        padding:25px;
    }
}
</style>

<div class="contact-page">

    <div class="contact-header">
        <h1>Contact Bakers Bakery</h1>
        <p>Ask questions, place orders, or send us your feedback.</p>
    </div>

    <div class="contact-info-grid">
        <div class="contact-card">
            <h3>Email</h3>
            <p>info@bakersbakery.com</p>
        </div>

        <div class="contact-card">
            <h3>Phone</h3>
            <p>+675 764 3210</p>
        </div>

        <div class="contact-card">
            <h3>Location</h3>
            <p>Madang, Papua New Guinea</p>
        </div>

        <div class="contact-card">
            <h3>Opening Hours</h3>
            <p>Monday - Saturday<br>8:00 AM - 5:00 PM</p>
        </div>
    </div>

    <div class="contact-form-wrapper">

        <h2>Send a Message</h2>
        <p>We'd love to hear from you.</p>

        <?php if($success): ?>
            <div class="success-msg">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <form class="contact-form" method="POST">

            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="name" placeholder="Enter your name" required>
            </div>

            <div class="form-group">
                <label>Your Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label>Subject</label>
                <input type="text" name="subject" placeholder="Enter a subject" required>
            </div>

            <div class="form-group">
                <label>Your Message</label>
                <textarea name="message" placeholder="Write your message here..." required></textarea>
            </div>

            <button class="submit-btn" type="submit">
                Send Message
            </button>

        </form>

    </div>

</div>

<?php include "../admin/footer.php"; ?>