document.addEventListener("DOMContentLoaded", function () {
    loadBooks();

    const bookForm = document.getElementById("bookForm");
    const resetBtn = document.getElementById("resetBtn");

    bookForm.addEventListener("submit", function (e) {
        e.preventDefault();

        let bookId = document.getElementById("bookId").value;
        let action = bookId === "" ? "add" : "update";

        let formData = new FormData(bookForm);
        formData.append("action", action);

        fetch("../ajax/book_ajax.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            showMessage(data.message, data.success);

            if (data.success) {
                bookForm.reset();
                document.getElementById("bookId").value = "";
                document.getElementById("formTitle").innerText = "Add New Book";
                document.getElementById("submitBtn").innerText = "Add Book";
                loadBooks();
            }
        });
    });

    resetBtn.addEventListener("click", function () {
        bookForm.reset();
        document.getElementById("bookId").value = "";
        document.getElementById("formTitle").innerText = "Add New Book";
        document.getElementById("submitBtn").innerText = "Add Book";
        document.getElementById("message").innerText = "";
    });
});

function loadBooks() {
    fetch("../ajax/book_ajax.php?action=view")
    .then(response => response.json())
    .then(data => {
        let tableBody = document.getElementById("bookTableBody");
        tableBody.innerHTML = "";

        if (data.success && data.data.length > 0) {
            data.data.forEach(book => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${book.id}</td>
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.category}</td>
                        <td>${book.availability_status}</td>
                        <td>
                            <button class="edit-btn" onclick="editBook(${book.id})">Edit</button>
                            <button class="delete-btn" onclick="deleteBook(${book.id})">Delete</button>
                        </td>
                    </tr>
                `;
            });
        } else {
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6">No book records found.</td>
                </tr>
            `;
        }
    });
}

function editBook(id) {
    let formData = new FormData();
    formData.append("action", "get");
    formData.append("id", id);

    fetch("../ajax/book_ajax.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let book = data.data;

            document.getElementById("bookId").value = book.id;
            document.getElementById("title").value = book.title;
            document.getElementById("author").value = book.author;
            document.getElementById("category").value = book.category;
            document.getElementById("availability_status").value = book.availability_status;

            document.getElementById("formTitle").innerText = "Update Book";
            document.getElementById("submitBtn").innerText = "Update Book";
        }
    });
}

function deleteBook(id) {
    if (!confirm("Are you sure you want to delete this book?")) {
        return;
    }

    let formData = new FormData();
    formData.append("action", "delete");
    formData.append("id", id);

    fetch("../ajax/book_ajax.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        showMessage(data.message, data.success);

        if (data.success) {
            loadBooks();
        }
    });
}

function showMessage(message, success) {
    let messageBox = document.getElementById("message");
    messageBox.innerText = message;

    if (success) {
        messageBox.style.color = "green";
    } else {
        messageBox.style.color = "red";
    }
}