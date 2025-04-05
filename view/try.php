<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="../public/css/table.css">
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Item Registration</h5>
            </div>

            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6 col-12">
                        <label for="excelFile" class="form-label">Upload Excel File</label>
                        <input type="file" class="form-control" id="excelFile" accept=".xlsx">
                    </div>
                    <div class="col-md-6 col-12 d-flex align-items-end">
                        <button class="btn btn-primary w-100" id="btnUpload">Upload File</button>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <button class="btn btn-success" id="btnAddRow">Add Row</button>
                    <button class="btn btn-danger" id="btnSubmit">Submit Data</button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm text-center" id="itemTable">
                        <thead class="table-light">
                            <tr>
                                <th>Part Number</th>
                                <th>Part Description</th>
                                <th>Option</th>
                                <th>Cost Center</th>
                                <th>Location</th>
                                <th>Min Inventory</th>
                                <th>Unit of Measure</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="new_part_number" class="form-control form-control-sm"
                                        placeholder="Part Number" autocomplete="off" required>
                                </td>
                                <td><input type="text" name="new_part_desc" class="form-control form-control-sm"
                                        placeholder="Part Description" autocomplete="off" required></td>
                                <td>
                                    <select name="new_option" class="form-select form-select-sm" required>
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="new_cost_center" class="form-select form-select-sm" required>
                                        <option>Cost Center 1</option>
                                        <option>Cost Center 2</option>
                                        <option>Cost Center 3</option>
                                    </select>
                                </td>
                                <td><input type="text" name="new_location" class="form-control form-control-sm"
                                        placeholder="Location" autocomplete="off" required></td>
                                <td><input type="number" name="new_min_invent_req" class="form-control form-control-sm"
                                        placeholder="Min. Invent Requirement" autocomplete="off" required></td>
                                <td><input type="text" name="new_unit" class="form-control form-control-sm" required>
                                </td>
                                <td><button class="btn btn-sm btn-danger"
                                        onclick="this.closest('tr').remove()">Delete</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>



            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            // Add Row Button
            $("#btnAddRow").on("click", function () {
                addRow();
            });

            // Upload Excel File
            $("#btnUpload").on("click", function () {
                const file = $("#excelFile")[0].files[0];
                if (!file) return Swal.fire('Please select an Excel file.');

                const reader = new FileReader();
                reader.onload = function (e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, { type: "array" });
                    const rows = XLSX.utils.sheet_to_json(workbook.Sheets[workbook.SheetNames[0]], { header: 1 }).slice(1);
                    rows.forEach(row => addRow({
                        new_part_number: row[0],
                        new_part_desc: row[1],
                        new_option: row[2],
                        new_cost_center: row[3],
                        new_location: row[4],
                        new_min_invent_req: parseInt(row[5]) || 0,
                        new_unit: row[6]
                    }));
                };
                reader.readAsArrayBuffer(file);
            });

            // Submit Button
            $("#btnSubmit").on("click", function () {
                let data = [];
                let valid = true;
                $("#itemTable tbody tr").each(function () {
                    let item = {};
                    $(this).find("input, select").each(function () {
                        item[$(this).attr("name")] = $(this).val();
                        if (!$(this).val()) {
                            valid = false;
                            $(this).addClass("is-invalid");
                        } else {
                            $(this).removeClass("is-invalid");
                        }
                    });
                    data.push(item);
                });

                if (!valid) {
                    return Swal.fire({
                        icon: 'warning',
                        title: 'Error',
                        text: 'Please fill in all fields.'
                    });
                }

                if (data.length === 0) return Swal.fire('No data to submit.');

                $.ajax({
                    url: "submit.php",
                    method: "POST",
                    contentType: "application/json",
                    data: JSON.stringify({ items: data }),
                    success: res => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: res.message || "Submitted successfully."
                        });
                        clearInputs();  // Clear inputs after successful submission
                    },
                    error: err => Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred.'
                    })
                });
            });
        });

        function addRow(data = {}) {
            const row = $("<tr></tr>");
            row.append(`
                <td><input type="text" name="new_part_number" class="form-control form-control-sm" value="${data.new_part_number || ''}" placeholder="Part Number" autocomplete="off" required></td>
                <td><input type="text" name="new_part_desc" class="form-control form-control-sm" value="${data.new_part_desc || ''}" placeholder="Part Description" autocomplete="off" required></td>
                <td><select name="new_option" class="form-select form-select-sm" required><option>Option 1</option><option>Option 2</option><option>Option 3</option></select></td>
                <td><select name="new_cost_center" class="form-select form-select-sm" required><option>Cost Center 1</option><option>Cost Center 2</option><option>Cost Center 3</option></select></td>
                <td><input type="text" name="new_location" class="form-control form-control-sm" value="${data.new_location || ''}" placeholder="Location" autocomplete="off" required></td>
                <td><input type="number" name="new_min_invent_req" class="form-control form-control-sm" value="${data.new_min_invent_req || ''}" placeholder="Min. Inventory Requirement" autocomplete="off" required></td>
                <td><input type="text" name="new_unit" class="form-control form-control-sm" value="${data.new_unit || ''}" required></td>
                <td><button class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">Delete</button></td>
            `);
            $("#itemTable tbody").append(row);
        }

        function clearInputs() {
            $("#itemTable tbody").empty(); // Clear the table
            addRow(); // Optionally add a new empty row
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>