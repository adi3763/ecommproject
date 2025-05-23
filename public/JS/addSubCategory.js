let submitButton = document.getElementById("submit-button");
submitButton.addEventListener("click", async function (e) {
    e.preventDefault();

    const form = submitButton.closest('form');
    const formData = new FormData(form);

    const response = await fetch("/admin/subcategory/insert", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: formData
    });

    const result = await response.json();
    if(result.status == 200){
        window.location.href = "/admin/categoryPage";
        alert(result.message);
        form.reset();
    } else {
        alert(result.message);
    }
});



let loadSubcategoriesButton = document.getElementById("loadSubcategories");
loadSubcategoriesButton.addEventListener("click", async function (e) {
    e.preventDefault();

    const categoryName = document.getElementById("category");
        const categoryvalue = categoryName.value;
        const subCategoryName = document.getElementById("subCategoryName").value;


const categoryId = categoryName.options[categoryName.selectedIndex].getAttribute("value");
    if (!categoryId) {
        alert("Invalid category selected.");
        return;
    }
    const response = await fetch(`/admin/category/loadData/${categoryId}`,{
        method:"GET",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        
    })

const result = await response.json();
// result.data is the category object, result.data.subcategories is the array you want
const subCategoryList = result.data && result.data.subcategories ? result.data.subcategories : [];
const subCategoryTableBody = document.getElementById("subcategoryTableBody");

if ( $.fn.DataTable.isDataTable('#subcategoryTable') ) {
    $('#subcategoryTable').DataTable().clear().destroy();
}
subCategoryTableBody.innerHTML = ""; // Clear previous results

if (Array.isArray(subCategoryList) && subCategoryList.length > 0) {
    subCategoryList.forEach((element, index) => {
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${index + 1}</td>
            <td>${element.subcategory_name}</td>
            <td>${element.created_at ? new Date(element.created_at).toLocaleString() : ''}</td>
            <td>
                <button id="delete-btn" class="btn btn-danger delete-subcategory" data-id="${element.id}">Delete</button>
            </td>
        `;
        subCategoryTableBody.appendChild(row);
    });



// if ($('#subcategoryTable tfoot').length === 0) {
//     $('#subcategoryTable').append(`
//         <tfoot>
//             <tr>
//                 <th>#</th>
//                 <th>Subcategory Name</th>
//                 <th>Created At</th>
//                 <th>Actions</th>
//             </tr>
//         </tfoot>
//     `);
// }
$('#subcategoryTable tfoot th').each(function () {
    const title = $(this).text();
    if (title !== 'Actions' && $(this).find('input').length === 0) {
        $(this).html(`<input type="text" placeholder="Search ${title}" class="form-control form-control-sm" />`);
    } else if (title === 'Actions') {
        $(this).html('');
    }
});
   


   
$('#subcategoryTable').DataTable({
    paging: true,
    searching: true,
    ordering: true,
    dom: 'Bfrtip',
    buttons: ['excelHtml5', 'csvHtml5', 'pdfHtml5', 'print'],
    initComplete: function () {
        this.api().columns().every(function () {
            const that = this;
            $('input', this.footer()).on('keyup change clear', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    }
});

subCategoryTableBody.querySelectorAll('.delete-subcategory').forEach((button) => {
    button.addEventListener("click", async function (e) {
        e.preventDefault();
        const subcategoryId = this.getAttribute("data-id");
        if (!confirm("Are you sure you want to delete this subcategory?")) return;
        const response = await fetch(`/admin/subcategory/delete/${subcategoryId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        });

        const result = await response.json();
        if (result.status == 200) {
            alert(result.message);
            // Reload the subcategories
            loadSubcategoriesButton.click();
        } else {
            alert(result.message);
        }
    });
});
  
  
} else {
    const row = document.createElement("tr");
    row.innerHTML = `<td colspan="4">No subcategories found.</td>`;
    subCategoryTableBody.appendChild(row);
}

});

// After you finish rendering the table rows:



