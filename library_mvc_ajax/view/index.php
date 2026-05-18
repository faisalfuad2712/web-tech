<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>University Library Management System</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h1>University Library Management System</h1>

    <div class="form-box">
        <h2 id="formTitle">Add New Book</h2>

        <form id="bookForm">
            <input type="hidden" id="bookId" name="id">

            <div class="form-group">
                <label>Book Title</label>
                <input type="text" id="title" name="title" placeholder="Enter book title">
            </div>

            <div class="form-group">
                <label>Author Name</label>
                <input type="text" id="author" name="author" placeholder="Enter author name">
            </div>

            <div class="form-group">
                <label>Category</label>
                <input type="text" id="category" name="category" placeholder="Enter category">
            </div>

            <div class="form-group">
                <label>Availability Status</label>
                <select id="availability_status" name="availability_status">
                    <option value="">Select status</option>
                    <option value="Available">Available</option>
                    <option value="Issued">Issued</option>
                </select>
            </div>

            <button type="submit" id="submitBtn">Add Book</button>
            <button type="button" id="resetBtn">Reset</button>
        </form>

        <p id="message"></p>
    </div>

    <div class="table-box">
        <h2>Book Records</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody id="bookTableBody"></tbody>
        </table>
    </div>
</div>

<script src="../assets/js/app.js"></script>
</body>
</html>