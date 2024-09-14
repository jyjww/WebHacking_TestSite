document.addEventListener("DOMContentLoaded", function() {
    const rowsPerPage = 5;
    const rows = document.querySelectorAll(".board_table tr:not(:first-child)");
    const rowsCount = rows.length;
    const pageCount = Math.ceil(rowsCount / rowsPerPage);
    const pagination = document.getElementById("pagination");

    let currentPage = 1;

    // Initialize pagination
    function initPagination() {
        pagination.innerHTML = "";

        // Previous button
        const prevButton = document.createElement("a");
        prevButton.href = "#";
        prevButton.innerHTML = "&laquo;";
        prevButton.classList.add("page-link");
        prevButton.addEventListener("click", function(e) {
            e.preventDefault();
            if (currentPage > 1) {
                currentPage--;
                displayPage(currentPage);
            }
        });
        pagination.appendChild(prevButton);

        // Page numbers
        for (let i = 1; i <= pageCount; i++) {
            const pageNumber = document.createElement("a");
            pageNumber.href = "#";
            pageNumber.innerHTML = i;
            pageNumber.classList.add("page-link");
            pageNumber.addEventListener("click", function(e) {
                e.preventDefault();
                currentPage = i;
                displayPage(currentPage);
            });
            pagination.appendChild(pageNumber);
        }

        // Next button
        const nextButton = document.createElement("a");
        nextButton.href = "#";
        nextButton.innerHTML = "&raquo;";
        nextButton.classList.add("page-link");
        nextButton.addEventListener("click", function(e) {
            e.preventDefault();
            if (currentPage < pageCount) {
                currentPage++;
                displayPage(currentPage);
            }
        });
        pagination.appendChild(nextButton);

        displayPage(currentPage);
    }

    // Display rows for the current page
    function displayPage(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;

        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });

        // Update active page number
        const pageLinks = pagination.querySelectorAll(".page-link");
        pageLinks.forEach(link => link.classList.remove("active"));
        pageLinks[page].classList.add("active");
    }

    initPagination();
});
