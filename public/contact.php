<?php
require_once '../config/db.php';
$pageTitle = 'Contact - Bakers Bakery Reviews';
require_once '../public/header.php';
include 'chatbot.php';

/* =========================
   HANDLE FORM SUBMISSION
========================= */
$success = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize input
    $fullName = trim($_POST['name'] ?? '');
    $subject  = trim($_POST['subject'] ?? 'Website Contact Message');
    $email    = trim($_POST['email'] ?? '');
    $message  = trim($_POST['message'] ?? '');

    // Validation
    if (empty($fullName) || empty($email) || empty($message)) {
        $error = "Please complete all required fields.";
    } else {

        /*
         * Find matching customer by email.
         * customer_id is required because contact_messages.customer_id
         * is a foreign key referencing customers.customer_id.
         */
        $customerId = null;

        $customerStmt = $conn->prepare(
            "SELECT customer_id
             FROM customers
             WHERE email = ?
             LIMIT 1"
        );
        $customerStmt->bind_param("s", $email);
        $customerStmt->execute();
        $customerResult = $customerStmt->get_result();
        $customer = $customerResult->fetch_assoc();
        $customerStmt->close();

        if ($customer) {
            $customerId = (int) $customer['customer_id'];
        } else {
            /*
             * No matching customer record exists.
             * Because customer_id is enforced by a foreign key,
             * we cannot insert a non-existent customer_id.
             */
            $error = "Your email address is not registered. Please create a customer account before sending a message.";
        }

        // Insert message only if customer exists
        if (empty($error)) {

            $stmt = $conn->prepare(
                "INSERT INTO contact_messages
                (customer_id, full_name, email, subject, message, status)
                VALUES (?, ?, ?, ?, ?, 'pending')"
            );

            $stmt->bind_param(
                "issss",
                $customerId,
                $fullName,
                $email,
                $subject,
                $message
            );

            if ($stmt->execute()) {
                $success = "Message sent successfully!";
            } else {
                $error = "Error sending message: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}
?>

<div class="content">
    <main class="main">
        <h2>Contact Bakers Bakery</h2>
        <p>Use the contact details below to ask questions, place orders, or send feedback.</p>

        <div class="contact-box">
            <p><strong>Email:</strong> info@bakersbakery.com</p>
            <p><strong>Phone:</strong> +675 764 3210</p>
            <p><strong>Location:</strong> Madang, Papua New Guinea</p>
            <p><strong>Opening Hours:</strong> Monday to Saturday, 8:00 AM - 5:00 PM</p>
        </div>

        <section class="section">
            <h2>Send a Message</h2>

            <?php if (!empty($success)): ?>
                <p class="success-msg"><?php echo htmlspecialchars($success); ?></p>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <p class="error-msg"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form class="review-form" method="POST">

                <label>Your Name</label>
                <input
                    type="text"
                    name="name"
                    placeholder="Enter your name"
                    required
                    value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">

                <label>Your Email</label>
                <input
                    type="email"
                    name="email"
                    placeholder="Enter your email"
                    required
                    value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">

                <label>Subject</label>
                <input
                    type="text"
                    name="subject"
                    placeholder="Message subject"
                    value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">

                <label>Message</label>
                <textarea
                    name="message"
                    placeholder="Write your message here"
                    required><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>

                <button class="btn submit-btn" type="submit">
                    Send Message
                </button>
            </form>
        </section>
    </main>
</div>

<?php include '../public/footer.php'; ?>