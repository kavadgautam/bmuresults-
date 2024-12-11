<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMU Portal</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    </script>
    <script src=
"https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js">
    </script>
    <script src=
 "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js">
    </script>
</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="index.php">BMU Portal Results</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="https://www.bmusurat.ac.in/">Home <span class="sr-only">(current)</span></a>
      </li>
  
      <li class="nav-item">
        <a class="nav-link" href="mailto:info@bmusurat.ac.in">info@bmusurat.ac.in</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center"> Enrollment Number.</h2>
    
    <!-- Search Form -->
    <form id="searchForm"  method="POST">
            <div class="form-row justify-content-center">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Enter Enrollment Number" id="enrollmentNo" name="enrollment_no" required>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" onclick="searchByEnrollmentNo()">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
</div>





 <div class="container mt-5">
        <h2 class="text-center mb-4">Results</h2>

       
        <!-- Table -->
        <table class="table table-bordered table-striped mt-4">
            <thead class="thead-dark" >
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Enrollment No</th>
                    <th scope="col">Exam Set No</th>
                </tr>
            </thead>
<HR>
            
            <tbody id="result">
                
            </tbody>
        </table>
    </div>


    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
           
        </tbody>
    </table>
    
    
<script>
        const filePath = './tableConvert.com_trqptj.xlsx.xlsx'; // Update the path to your Excel file

        let dataRows = []; // Store rows of Excel data

        // Function to read and parse the Excel file
        fetch(filePath)
            .then(response => response.arrayBuffer()) // Get the file content as ArrayBuffer
            .then(data => {
                var workbook = XLSX.read(data, { type: 'array' });

                // Assuming the data is on the first sheet
                var sheet = workbook.Sheets[workbook.SheetNames[0]];
                var rows = XLSX.utils.sheet_to_json(sheet, { header: 1 });

                // Store rows for later searching
                dataRows = rows;
            })
            .catch(error => console.error('Error reading the Excel file:', error));

        // Function to search for the Name by Enrollment Number
        function searchByEnrollmentNo() {
            const enrollmentNoInput = document.getElementById('enrollmentNo').value.trim();
            const resultElement = document.getElementById('result');

            // Clear previous results
            resultElement.innerHTML = '';

            if (enrollmentNoInput === '') {
                resultElement.innerHTML = '<tr><td colspan="3" class="text-center">Please enter an enrollment number.</td></tr>';
                return;
            }

            // Search for the given Enrollment Number
            let found = false;
            dataRows.forEach(function(row, index) {
                if (index > 0 && row[1] == enrollmentNoInput) { // Skip header row and match enrollment number
                    resultElement.innerHTML = `
                        <tr>
                            <td>${row[0]}</td>
                            <td>${row[1]}</td>
                            <td>${row[2]}</td>
                        </tr>

                            <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Subject</th>
                <th scope="col">Subject CODE</th>
        
                <th scope="col">Result</th>
                <th scope="col">Grade</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Network Security</td>
                <td>01CE0605</td>
                <td>Pass</td>
                <td>B+</td>

            </tr>
            <tr>
                <td>Data Structures and Algorithms</td>
                <td>2130702D</td>
                <td>Pass</td>
                <td>B</td>
  
            </tr>
            <tr>
                <td>Database Management Systems</td>
                <td>CS402ES</td>
                <td>Pass</td>
                <td>B+</td>
      
            </tr>
            <tr>
                <td>.NET Software Engineering</td>
                <td>BC3340704</td>
                <td>Pass</td>
                <td>B</td>
 
            </tr>
            <tr>
                <td>Operating Systems</td>
                <td>MCC510</td>
                <td>Pass</td>
                <td>B</td>
    
            </tr>
        </tbody>
    </table>

    <div class="container mt-5">

    <!-- Table -->
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Result</th>
                <th scope="col">Tond Backlog</th>
                <th scope="col">CGPA</th>
                <th scope="col">Cleared Exam</th>
                


            </tr>
        </thead>
        <tbody>
            <tr>
                <td>second class </td>
                <td>0</td>
                <td>6.3</td>
                <td> The First Attempt Passed </td>
            </tr>
        
          
        </tbody>
    </table>
</div>
<br>
<input  type="button" value="PDF  Download"               
                onclick="convertHTMLtoPDF()">

                <br>

                    <table class="table table-bordered table-striped">
  
        <tbody>
            <tr style="color: #ff0000;">
                <td>નોટિસ:-</td>
                <td>Physical ડિગ્રી, દસ્તાવેજ અને 1-6 સેમ પરિણામ 25/12/2024 થી 28/12/2024 દરમિયાન આપવામાં આવશે.</td>
                <td>તમામ આરટીઆઈ દસ્તાવેજો અને એફિડેવિટ બે દિવસમાં mail દ્વારા મોકલવામાં આવશે</td>
                <td> જો તમારું કોઈપણ પરિણામ તમારી કોલેજના નકલી પરિણામ સંબંધિત કોઈપણ પોલીસ કેસ સાથે સંબંધિત હશે, તો તમારું પરિણામ રદ કરવામાં આવશે.</td>
            </tr>
        
          
        </tbody>
    </table>
</div>

                    `;
                    found = true;
                }
            });

            if (!found) {
                resultElement.innerHTML = '<tr><td colspan="3" class="text-center">Enrollment number not found.</td></tr>';
            }
        }

        function convertHTMLtoPDF() {
            const { jsPDF } = window.jspdf;
 
            let doc = new jsPDF('l', 'mm', [1500, 1400]);
            let pdfjs = document.querySelector('#result');
 
            doc.html(pdfjs, {
                callback: function(doc) {
                    doc.save("newpdf.pdf");
                },
                x: 12,
                y: 12
            });                
        }            
    </script>

<!-- Bootstrap JS and jQuery (for toggling navbar) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
