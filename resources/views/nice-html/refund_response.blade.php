<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <style>
  table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        </style>
</head>
<body>
    <div class="container">
        
            <!-- Display the response data if needed -->
            {{-- <pre>{{ $responseData }}</pre> --}}
            <h1>Refund Response</h1>
            <table border="1">
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
                @foreach($response as $key => $value)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>{{ $value }}</td>
                    </tr>
                @endforeach
            </table>
            {{-- <table>
                <thead>
                    <tr>
                        <th>REFUNDID</th>
                        <th>SUBORDERID</th>
                        <th>REFUNDSTATUS</th>
                        <th>REFUNDTIMESTAMP</th>
                        <th>STATUS</th>
                        <th>REMARKS</th>
                        <th>RESPONSECODE</th>
                        <th>RESPONSEMESSAGE</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($response['data']))
                        @foreach($response['data'] as $item)
                            <tr>
                                <td>{{ $item['REFUNDID'] ?? '' }}</td>
                                <td>{{ $item['SUBORDERID'] ?? '' }}</td>
                                <td>{{ $item['REFUNDSTATUS'] ?? '' }}</td>
                                <td>{{ $item['REFUNDTIMESTAMP'] ?? '' }}</td>
                                <td>{{ $item['STATUS'] ?? '' }}</td>
                                <td>{{ $item['REMARKS'] ?? '' }}</td>
                                <td>{{ $item['RESPONSECODE'] ?? '' }}</td>
                                <td>{{ $item['RESPONSEMESSAGE'] ?? '' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8">No data available.</td>
                        </tr>
                    @endif
                </tbody>
            </table> --}}
        
    </div>
 
        {{-- <script>
          $(document).ready(function () {
        // Get the query parameter from the URL
        var queryString = window.location.search;
        var urlParams = new URLSearchParams(queryString);

        // Get the values of the response fields from the query parameters
        // var PRN = urlParams.get('PRN');
        // var RPPTXNID = urlParams.get('RPPTXNID');
        // var AMOUNT = urlParams.get('AMOUNT');
        // var SUBORDERID = urlParams.get('SUBORDERID');
        var STATUS = urlParams.get('STATUS');
        var RESPONSECODE = urlParams.get('RESPONSECODE');
        var RESPONSEMESSAGE = urlParams.get('RESPONSEMESSAGE');
        var REFUNDID = urlParams.get('REFUNDID');
        var REFUNDSTATUS = urlParams.get('REFUNDSTATUS');
        var REFUNDTIMESTAMP = urlParams.get('REFUNDTIMESTAMP');
        var REMARKS = urlParams.get('REMARKS');

        // Access the HTML elements and set their values
        // if (PRN) document.getElementById("prn").innerText = PRN;
        // if (RPPTXNID) document.getElementById("rpptxnid").innerText = RPPTXNID;
        // if (AMOUNT) document.getElementById("amount").innerText = AMOUNT;
        // if (SUBORDERID) document.getElementById("suborderid").innerText = SUBORDERID;
        if (STATUS) document.getElementById("status").innerText = STATUS;
        if (RESPONSECODE) document.getElementById("responsecode").innerText = RESPONSECODE;
        if (RESPONSEMESSAGE) document.getElementById("responsemessage").innerText = RESPONSEMESSAGE;
        if (REFUNDID) document.getElementById("refundid").innerText = REFUNDID;
        if (REFUNDSTATUS) document.getElementById("refundstatus").innerText = REFUNDSTATUS;
        if (REFUNDTIMESTAMP) document.getElementById("refundtimestamp").innerText = REFUNDTIMESTAMP;
        if (REMARKS) document.getElementById("remarks").innerText = REMARKS;
    });
</script> --}}
</body>
</html>