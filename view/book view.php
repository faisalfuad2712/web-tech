<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University Library Management System</title>
</head>
<body>
    <table width="100%" cellpadding="10" cellspacing="0">
        <tr>
            <td align="center">
                <h1>University Library Management System</h1>
            </td>
        </tr>
    </table>

    <hr>

    <table width="90%" align="center" cellpadding="10" cellspacing="0">
        <tr>
            <td>
                <h2 id="formTitle">Add New Book</h2>
                <p>Fill in the book information below and submit the form. Edit will load a record back into this same form.</p>
            </td>
        </tr>
    </table>

    <form id="bookForm">
        <input type="hidden" id="bookId" name="id">

        <table border="1" width="90%" align="center" cellpadding="10" cellspacing="0">
            <tr>
                <th align="left"><label for="title">Book Title</label></th>
                <td><input type="text" id="title" name="title" placeholder="Enter book title" size="45" required></td>
                <th align="left"><label for="author">Author Name</label></th>
                <td><input type="text" id="author" name="author" placeholder="Enter author name" size="45" required></td>
            </tr>
            <tr>
                <th align="left"><label for="category">Category</label></th>
                <td><input type="text" id="category" name="category" placeholder="Example: Computer Science" size="45" required></td>
                <th align="left"><label for="status">Availability</label></th>
                <td>
                    <select id="status" name="status" required>
                        <option value="">Select status</option>
                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="4" align="center">
                    <button type="submit" id="submitBtn">Add Book</button>
                    <button type="button" id="cancelBtn">Cancel</button>
                </td>
            </tr>
        </table>
    </form>

    <table width="90%" align="center" cellpadding="5" cellspacing="0">
        <tr>
            <td align="center">
                <p id="message"></p>
            </td>
        </tr>
    </table>

    <br>

    <table width="90%" align="center" cellpadding="10" cellspacing="0">
        <tr>
            <td>
                <h2>Book Records</h2>
            </td>
            <td align="right">
                <button type="button" id="refreshBtn">Refresh Records</button>
            </td>
        </tr>
    </table>

    <table border="1" cellpadding="8" cellspacing="0" width="90%" align="center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="bookTableBody">
            <tr>
                <td colspan="6" align="center">Loading books...</td>
            </tr>
        </tbody>
    </table>

    <script src="assets/js/app.js"></script>
</body>
</html>