function editProduct(id) {
  window.location.href = `/product/edit/${id}`;
}

async function deleteProduct(id) {
    if (confirm("Are you sure you want to delete product ID " + id + "?")) {
     const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const response = await fetch(`/product/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        });
        const data = await response.json();
        console.log(data);
        if (response.ok) {
            // Optionally, you can refresh the page or remove the product from the list
            alert("Product deleted successfully!");
            window.location.reload();
        } else {
            alert("Failed to delete product. Please try again.");
        }
    }
  }


let category = document.getElementById("category");
category.addEventListener("change", async function (e) {
let categoryId = this.value;
console.log(categoryId);
   const subcategorySelect = document.getElementById('subcategory');
            subcategorySelect.innerHTML = '<option value="">-- Loading --</option>';

            if (categoryId) {
                try {
                    const response = await fetch(`/product/subcategories/${categoryId}`);
                    const data = await response.json();
                    console.log(data);
                    console.log(data.id);

                    let options = '<option value="">-- Select Subcategory --</option>';
                    data.forEach(subcat => {
                        console.log(subcat);
                        options += `<option name="subcategory_id" value="${subcat.id}">${subcat.subcategory_name}</option>`;
                    });

                    subcategorySelect.innerHTML = options;

                } catch (error) {
                    console.error('Fetch error:', error);
                    subcategorySelect.innerHTML = '<option value="">-- Error loading --</option>';
                }
            } else {
                subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            }
        
});

let sec_category = document.getElementById("sec_category");
sec_category.addEventListener("change", async function (e) {
let categoryId = this.value;
console.log(categoryId);
   const subcategorySelect = document.getElementById('sec_subcategory');
            subcategorySelect.innerHTML = '<option value="">-- Loading --</option>';

            if (categoryId) {
                try {
                    const response = await fetch(`/product/secsubcategories/${categoryId}`);
                    const data = await response.json();
                    console.log(data);
                    console.log(data.id);

                    let options = '<option value="">-- Select Subcategory --</option>';
                    data.forEach(subcat => {
                        console.log(subcat);
                        options += `<option name="subcategory_id" value="${subcat.id}">${subcat.subcategory_name}</option>`;
                    });

                    subcategorySelect.innerHTML = options;

                } catch (error) {
                    console.error('Fetch error:', error);
                    subcategorySelect.innerHTML = '<option value="">-- Error loading --</option>';
                }
            } else {
                subcategorySelect.innerHTML = '<option value="">-- Select Subcategory --</option>';
            }
        
});

let productButton = document.getElementById("loadProducts");
productButton.addEventListener("click", async function (e) {
    e.preventDefault();

    if ( $.fn.DataTable.isDataTable('#ProductListTable') ) {
    $('#ProductListTable').DataTable().clear().destroy();
}

    let subCategoryId = document.getElementById("sec_subcategory").value;
    console.log(subCategoryId);

    const response = await fetch(`/admin/product/show/${subCategoryId}`);
    const productData = await response.json();
    console.log(productData);

    const tbody = document.getElementById("subcategoryTableBody");
    tbody.innerHTML = ""; // Clear previous rows


  productData.forEach((item, index) => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${index + 1}</td>
      <td>${item.productname}</td>
      <td>${item.product_price}</td>
      <td>${item.product_discription}</td>
      <td>${item.product_quantity}</td>
      <td>${item.product_size}</td>
      <td>${new Date(item.created_at).toLocaleString()}</td>
      <td>
        <button class="btn btn-sm btn-warning me-1 m-1" onclick="editProduct(${item.id})">Edit</button>
        <button class="btn btn-sm btn-danger" onclick="deleteProduct(${item.id})">Delete</button>
      </td>
    `;

    tbody.appendChild(row);
  });

  // Destroy existing DataTable instance if it exists


// Add search inputs to each footer cell (except Actions)
$('#ProductListTable tfoot th').each(function () {
    const title = $(this).text();
    if (title !== 'Actions') {
        $(this).html(`<input type="text" placeholder="Search ${title}" class="form-control form-control-sm" />`);
    } else {
        $(this).html('');
    }
});

// Initialize DataTable with export buttons and column search
$('#ProductListTable').DataTable({
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

  // Example functions
 

  


});






