const form = document.getElementById('bookForm');
const bookIdInput = document.getElementById('bookId');
const titleInput = document.getElementById('title');
const authorInput = document.getElementById('author');
const categoryInput = document.getElementById('category');
const statusInput = document.getElementById('status');

const tableBody = document.getElementById('bookTableBody');
const message = document.getElementById('message');

const formTitle = document.getElementById('formTitle');
const submitBtn = document.getElementById('submitBtn');
const cancelBtn = document.getElementById('cancelBtn');
const refreshBtn = document.getElementById('refreshBtn');

const endpoint = 'ajax/book_handler.php';


// ==============================
// PAGE LOAD EVENTS
// ==============================

document.addEventListener('DOMContentLoaded', () => {

    loadBooks();
});

form.addEventListener('submit', saveBook);

cancelBtn.addEventListener('click', resetForm);

refreshBtn.addEventListener('click', loadBooks);


// ==============================
// SEND AJAX REQUEST
// ==============================

async function sendRequest(action, data = {}) {

    const formData = new FormData();

    formData.append('action', action);

    // Append Extra Data
    Object.keys(data).forEach((key) => {

        formData.append(key, data[key]);
    });

    try {

        const response = await fetch(endpoint, {

            method: 'POST',
            body: formData
        });

        return await response.json();

    } catch (error) {

        throw error;
    }
}


// ==============================
// LOAD ALL BOOKS
// ==============================

async function loadBooks() {

    tableBody.innerHTML = `
    
        <tr>
            <td colspan="6" align="center">
                Loading books...
            </td>
        </tr>
    `;

    try {

        const result = await sendRequest('get_books');

        if (result.success) {

            renderBooks(result.data);

        } else {

            showMessage(result.message, 'error');
        }

    } catch (error) {

        showMessage(
            'Unable to load books. Database connection problem.',
            'error'
        );
    }
}


// ==============================
// DISPLAY BOOKS
// ==============================

function renderBooks(books) {

    if (books.length === 0) {

        tableBody.innerHTML = `
        
            <tr>
                <td colspan="6" align="center">
                    No books found.
                </td>
            </tr>
        `;

        return;
    }

    tableBody.innerHTML = books.map((book) => `

        <tr>

            <td>${escapeHtml(book.id)}</td>

            <td>${escapeHtml(book.title)}</td>

            <td>${escapeHtml(book.author)}</td>

            <td>${escapeHtml(book.category)}</td>

            <td>${escapeHtml(book.status)}</td>

            <td align="center">

                <button
                    type="button"
                    onclick="editBook(${book.id})"
                >
                    Edit
                </button>

                <button
                    type="button"
                    onclick="deleteBook(${book.id})"
                >
                    Delete
                </button>

            </td>

        </tr>

    `).join('');
}


// ==============================
// ADD OR UPDATE BOOK
// ==============================

async function saveBook(event) {

    event.preventDefault();

    const id = bookIdInput.value;

    const action = id
        ? 'update_book'
        : 'add_book';

    const payload = {

        id: id,

        title: titleInput.value,

        author: authorInput.value,

        category: categoryInput.value,

        status: statusInput.value
    };

    try {

        const result = await sendRequest(action, payload);

        showMessage(
            result.message,
            result.success ? 'success' : 'error'
        );

        if (result.success) {

            resetForm();

            loadBooks();
        }

    } catch (error) {

        showMessage(
            'Request failed. Please try again.',
            'error'
        );
    }
}


// ==============================
// EDIT BOOK
// ==============================

async function editBook(id) {

    try {

        const result = await sendRequest('get_book', { id });

        if (!result.success) {

            showMessage(result.message, 'error');
            return;
        }

        const book = result.data;

        bookIdInput.value = book.id;
        titleInput.value = book.title;
        authorInput.value = book.author;
        categoryInput.value = book.category;
        statusInput.value = book.status;

        formTitle.textContent = 'Update Book';

        submitBtn.textContent = 'Update Book';

        titleInput.focus();

    } catch (error) {

        showMessage(
            'Unable to load selected book.',
            'error'
        );
    }
}


// ==============================
// DELETE BOOK
// ==============================

async function deleteBook(id) {

    const confirmation = confirm(
        'Are you sure you want to delete this book?'
    );

    if (!confirmation) {

        return;
    }

    try {

        const result = await sendRequest(
            'delete_book',
            { id }
        );

        showMessage(
            result.message,
            result.success ? 'success' : 'error'
        );

        if (result.success) {

            loadBooks();
        }

    } catch (error) {

        showMessage(
            'Unable to delete book.',
            'error'
        );
    }
}


// ==============================
// RESET FORM
// ==============================

function resetForm() {

    form.reset();

    bookIdInput.value = '';

    formTitle.textContent = 'Add New Book';

    submitBtn.textContent = 'Add Book';
}


// ==============================
// SHOW MESSAGE
// ==============================

function showMessage(text, type) {

    message.textContent = text;

    message.className = type;

    setTimeout(() => {

        message.textContent = '';

        message.className = '';

    }, 3000);
}


// ==============================
// ESCAPE HTML
// ==============================

function escapeHtml(value) {

    return String(value).replace(

        /[&<>"']/g,

        (character) => ({

            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'

        })[character]
    );
}