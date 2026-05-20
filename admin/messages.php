<?php
include "../config/db.php";
include "../admin/header.php";

/* =========================
   APPROVE MESSAGE
========================= */
if(isset($_GET['approve'])){

    $id = $_GET['approve'];

    $sql = "UPDATE contact_messages 
            SET status='approved'
            WHERE message_id='$id'";

    $conn->query($sql);

    header("Location: messages.php");
    exit();
}

/* =========================
   DELETE MESSAGE
========================= */
if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    $sql = "DELETE FROM contact_messages
            WHERE message_id='$id'";

    $conn->query($sql);

    header("Location: messages.php");
    exit();
}
?>

<div class="container">

    <h1 class="page-title">Customer Messages</h1>

    <div class="messages-grid">

        <?php

        $sql = "SELECT * FROM contact_messages ORDER BY message_id DESC";

        $result = $conn->query($sql);

        while($row = $result->fetch_assoc()):

        ?>

        <div class="message-card <?php echo $row['status']; ?>">

            <h3>
                <?php echo htmlspecialchars($row['full_name']); ?>
            </h3>

            <p class="email">
                <?php echo htmlspecialchars($row['email']); ?>
            </p>

            <p class="message-text">
                <?php echo nl2br(htmlspecialchars($row['message'])); ?>
            </p>

            <p class="status">
                Status:
                <strong>
                    <?php echo ucfirst($row['status']); ?>
                </strong>
            </p>

            <div class="message-actions">

                <?php if($row['status'] == 'pending'): ?>

                    <a
                        href="messages.php?approve=<?php echo $row['message_id']; ?>"
                        class="approve-btn"
                    >
                        Approve
                    </a>

                <?php endif; ?>

                <a
                    href="messages.php?delete=<?php echo $row['message_id']; ?>"
                    class="delete-btn"
                    onclick="return confirm('Delete this message?')"
                >
                    Delete
                </a>

            </div>

        </div>

        <?php endwhile; ?>

    </div>

</div>

<?php include "../admin/footer.php"; ?>