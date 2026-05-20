<?php
$pageTitle = "Manage Reviews";

include "../config/db.php";
include "../admin/header.php";

/* =========================================
   HANDLE REVIEW ACTIONS
========================================= */

/*
STATUS:
0 = Pending
1 = Approved
*/

/* APPROVE REVIEW */
if (isset($_GET['approve'])) {

    $reviewID = (int) $_GET['approve'];

    $stmt = $conn->prepare("
        UPDATE customer_reviews
        SET status = 'approved'
        WHERE review_id = ?
    ");

    $stmt->bind_param("i", $reviewID);
    $stmt->execute();
    $stmt->close();

    header("Location: reviews.php");
    exit();
}

/* DELETE REVIEW */
if (isset($_GET['delete'])) {

    $reviewID = (int) $_GET['delete'];

    $stmt = $conn->prepare("
        DELETE FROM customer_reviews
        WHERE review_id = ?
    ");

    $stmt->bind_param("i", $reviewID);
    $stmt->execute();
    $stmt->close();

    header("Location: reviews.php");
    exit();
}

/* =========================================
   FETCH ALL REVIEWS
========================================= */

$sqlReviews = "
    SELECT cr.*, c.full_name, p.product_name
    FROM customer_reviews cr
    JOIN customers c ON cr.customer_id = c.customer_id
    JOIN products p ON cr.product_id = p.product_id
    ORDER BY review_id DESC
";

$resultReviews = $conn->query($sqlReviews);

/* =========================================
   STAR DISPLAY
========================================= */

function displayStars(int $rating): string {

    $stars = "";

    $rating = max(0, min($rating, 5));

    for ($i = 1; $i <= 5; $i++) {
        $stars .= ($i <= $rating) ? "*" : "-";
    }

    return $stars;
}
?>

<style>

/* =========================================
   PAGE
========================================= */

.reviews-page{
    width:100%;
    min-height:100vh;
    padding:50px 6%;
    background:#f5efe6;
}

/* =========================================
   HEADER
========================================= */

.reviews-header{
    margin-bottom:40px;
}

.reviews-header h1{
    font-size:40px;
    color:#8b4513;
    margin-bottom:10px;
}

.reviews-header p{
    color:#666;
    font-size:17px;
}

/* =========================================
   TABLE CONTAINER
========================================= */

.reviews-container{
    background:#fff;
    border-radius:20px;
    padding:30px;
    box-shadow:0 8px 25px rgba(0,0,0,0.08);
    overflow-x:auto;
}

/* =========================================
   TABLE
========================================= */

.reviews-table{
    width:100%;
    border-collapse:collapse;
}

.reviews-table thead{
    background:#c97b4b;
}

.reviews-table thead th{
    color:#fff;
    padding:18px;
    text-align:left;
    font-size:16px;
}

.reviews-table tbody tr{
    border-bottom:1px solid #eee;
    transition:0.3s ease;
}

.reviews-table tbody tr:hover{
    background:#faf7f2;
}

.reviews-table td{
    padding:18px;
    vertical-align:top;
    color:#444;
    line-height:1.6;
}

/* =========================================
   STATUS
========================================= */

.status{
    padding:8px 14px;
    border-radius:30px;
    font-size:14px;
    font-weight:bold;
    display:inline-block;
}

.status-approved{
    background:#dff5e1;
    color:#1d7a32;
}

.status-pending{
    background:#fff3cd;
    color:#856404;
}

/* =========================================
   ACTION BUTTONS
========================================= */

.action-buttons{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
}

.btn{
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    font-size:14px;
    font-weight:bold;
    transition:0.3s ease;
    display:inline-block;
}

/* APPROVE BUTTON */

.btn-approve{
    background:#28a745;
    color:#fff;
}

.btn-approve:hover{
    background:#1e7e34;
}

/* DELETE BUTTON */

.btn-delete{
    background:#dc3545;
    color:#fff;
}

.btn-delete:hover{
    background:#b52a37;
}

/* =========================================
   EMPTY MESSAGE
========================================= */

.no-reviews{
    text-align:center;
    padding:40px;
    color:#777;
    font-size:18px;
}

/* =========================================
   RESPONSIVE
========================================= */

@media(max-width:768px){

    .reviews-page{
        padding:30px 4%;
    }

    .reviews-header h1{
        font-size:30px;
    }

    .reviews-container{
        padding:20px;
    }

    .reviews-table thead{
        display:none;
    }

    .reviews-table,
    .reviews-table tbody,
    .reviews-table tr,
    .reviews-table td{
        display:block;
        width:100%;
    }

    .reviews-table tr{
        margin-bottom:20px;
        background:#fff;
        border-radius:15px;
        padding:15px;
        box-shadow:0 5px 15px rgba(0,0,0,0.05);
    }

    .reviews-table td{
        padding:10px 0;
        border:none;
    }

}

</style>

<div class="reviews-page">

    <!-- HEADER -->

    <div class="reviews-header">

        <h1>Manage Customer Reviews</h1>

        <p>
            Approve or remove customer reviews submitted from the frontend website.
        </p>

    </div>

    <!-- REVIEWS TABLE -->

    <div class="reviews-container">

        <?php if($resultReviews->num_rows > 0): ?>

            <table class="reviews-table">

                <thead>

                    <tr>
                        <th>Customer</th>
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php while($review = $resultReviews->fetch_assoc()): ?>

                        <tr>

                            <!-- CUSTOMER -->

                            <td>
                                <strong>
                                    <?php echo htmlspecialchars($review['full_name']); ?>
                                </strong>
                            </td>

                            <!-- PRODUCT -->

                            <td>
                                <?php echo htmlspecialchars($review['product_name']); ?>
                            </td>

                            <!-- RATING -->

                            <td>
                                <?php echo displayStars($review['rating']); ?>
                            </td>

                            <!-- COMMENT -->

                            <td>
                                "<?php echo htmlspecialchars($review['comment']); ?>"
                            </td>

                            <!-- STATUS -->

                            <td>

                                <?php if($review['status'] == 'approved'): ?>

                                    <span class="status status-approved">
                                        Approved
                                    </span>

                                <?php else: ?>

                                    <span class="status status-pending">
                                        Pending
                                    </span>

                                <?php endif; ?>

                            </td>

                            <!-- ACTIONS -->

                            <td>

                                <div class="action-buttons">

                                    <?php if($review['status'] == 0): ?>

                                        <a
                                            class="btn btn-approve"
                                            href="reviews.php?approve=<?php echo $review['review_id']; ?>"
                                            onclick="return confirm('Approve this review?')"
                                        >
                                            Approve
                                        </a>

                                    <?php endif; ?>

                                    <a
                                        class="btn btn-delete"
                                        href="reviews.php?delete=<?php echo $review['review_id']; ?>"
                                        onclick="return confirm('Delete this review?')"
                                    >
                                        Delete
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endwhile; ?>

                </tbody>

            </table>

        <?php else: ?>

            <div class="no-reviews">
                No customer reviews found.
            </div>

        <?php endif; ?>

    </div>

</div>

<?php include "../admin/footer.php"; ?>