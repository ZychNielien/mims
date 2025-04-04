<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Registration</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- SheetJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Item Registration</h2>

        <!-- Excel Upload -->
        <div class="mb-3">
            <label for="excelFile" class="form-label">Upload Excel (.XLSX):</label>
            <input type="file" id="excelFile" class="form-control" accept=".xlsx">
        </div>
        <button class="btn btn-primary" onclick="uploadExcel()">Upload</button>

        <br><br>

        <!-- Dynamic Table -->
        <table class="table table-striped" id="itemTable">
            <thead>
                <tr>
                    <th>Part Number</th>
                    <th>Part Description</th>
                    <th>Option</th>
                    <th>Cost Center</th>
                    <th>Location</th>
                    <th>Minimum Inventory Requirement</th>
                    <th>Unit of Measure</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <br>
        <button class="btn btn-success" onclick="addRow()">Add Row</button>
        <button class="btn btn-danger" onclick="submitData()">Submit Data</button>
    </div>

    <script>
        function addRow(data = {}) {
            let table = $("#itemTable tbody");
            let newRow = $("<tr></tr>");

            let columns = ["part_number", "part_description", "option", "cost_center", "location", "min_inventory", "unit_of_measure"];

            columns.forEach(col => {
                let cell = $("<td></td>");
                let input = $("<input>").attr({
                    type: col === "min_inventory" ? "number" : "text",
                    name: col,
                    value: data[col] || ""
                }).addClass("form-control");

                cell.append(input);
                newRow.append(cell);
            });

            let actionCell = $("<td></td>");
            let deleteButton = $("<button></button>").addClass("btn btn-danger btn-sm").text("Delete");
            deleteButton.click(function () { newRow.remove(); });
            actionCell.append(deleteButton);
            newRow.append(actionCell);

            table.append(newRow);
        }

        function uploadExcel() {
            let fileInput = $("#excelFile")[0];
            let file = fileInput.files[0];

            if (!file) return alert("Please select an Excel file.");

            let reader = new FileReader();
            reader.readAsArrayBuffer(file);

            reader.onload = function (e) {
                let data = new Uint8Array(e.target.result);
                let workbook = XLSX.read(data, { type: "array" });

                let sheetName = workbook.SheetNames[0];
                let sheet = workbook.Sheets[sheetName];
                let jsonData = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                jsonData.shift(); // Remove header row

                jsonData.forEach(row => {
                    let item = {
                        part_number: row[0],
                        part_description: row[1],
                        option: row[2],
                        cost_center: row[3],
                        location: row[4],
                        min_inventory: parseInt(row[5]) || 0,
                        unit_of_measure: row[6]
                    };
                    addRow(item);
                });
            };
        }

        function submitData() {
            let data = [];
            $("#itemTable tbody tr").each(function () {
                let row = $(this);
                let item = {
                    part_number: row.find("input[name='part_number']").val(),
                    part_description: row.find("input[name='part_description']").val(),
                    option: row.find("input[name='option']").val(),
                    cost_center: row.find("input[name='cost_center']").val(),
                    location: row.find("input[name='location']").val(),
                    min_inventory: parseInt(row.find("input[name='min_inventory']").val()) || 0,
                    unit_of_measure: row.find("input[name='unit_of_measure']").val()
                };
                data.push(item);
            });

            if (data.length === 0) return alert("No valid data to submit.");

            $.ajax({
                url: "submit.php",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({ items: data }),
                success: function (result) {
                    alert(result.message);
                },
                error: function (error) {
                    console.error("Error:", error);
                    alert("Something went wrong!");
                }
            });
        }
    </script>

    <!-- Bootstrap 5 JS (Optional for interactive components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>