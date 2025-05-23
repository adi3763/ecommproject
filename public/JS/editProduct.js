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