<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Quote {{ $job_id }}</title>
    <style>
    body {
        font-family: Times New Roman;
        font-size: 0.9em;
        margin-top:25px;
        margin-left:45px;
        margin-right:45px;
        margin-bottom:10px;
    }

    div#header, div#footer {
        padding: 10px;
        color: white;
        background-color: black;
    }

    div#content {
        margin: 5px;
        padding: 10px;
        background-color: lightgrey;
    }

    div.article {
        margin: 5px;
        padding: 10px;
        background-color: white;
    }

    div#menu ul {
        padding: 0;
    }

    div#menu ul li {
        display: inline;
        margin: 5px;
    }
    .title_block {
        border-bottom: 1px solid #000;
        padding-bottom: 1px;
        margin-bottom: 1px;
    }
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 0px solid #dddddd;
        padding: 8px;
    }
    
    td.newtable, th.newtable {
        border: 0px solid #dddddd;
        padding: 2px;
    }
    </style>    
    </head>
<body>
    <div>
        <img align="left" src="assets/images/logo-icon4.png" width="280" height="80" />
        <div align="right">
            <b><label style="font-size:12px;">#108, First Floor, Azaiba Mall</label><br>
            <label style="font-size:12px;">Azaba, Muscat, Oman</label><br></b>
            <label style="font-size:12px;">+968 963 12346 /47 </label><img style="margin-top:2px;" src="assets/images/icon-tel.png" width="14" height="12" /><br>
            <label style="font-size:12px;">info@spacedatarecovery.com</label><img style="margin-top:2px;" src="assets/images/icon-mail.png" width="14" height="12" /><br>
            <label style="font-size:12px;">www.spacedatarecovery.com</label><img style="margin-top:2px;" src="assets/images/icon-space.png" width="14" height="12" /><br>
        </div>
    </div>
    <br><br><br><br>
    <div>
        <img align="left" src="assets/images/quote.png" width="280" height="80" />
        <div align="right">
            <b><label style="font-size:17px;">Quote To</label></b><br>
            <label style="font-size:16px;">{{$client->client_name}}</label><br>
            <label style="font-size:16px;">{{$client->company}}</label><br>
            <label style="font-size:16px;">{{$client->phone_value}}</label>
        </div>
    </div>
    <table style="border-bottom:0pt solid grey;width:100%">
        <tbody style="font-size:15px;">
            <tr>
            <td class="newtable"><label style="font-size:15px;">#Quote</label></td>
            <td class="newtable" style="font-size:15px;" >#Date</td>
            <td class="newtable" style="font-size:16px;" align="right">{{$client->street}}</td>
            </tr>
            <tr>
            <td class="newtable"><b><label style="font-size:15px;">{{$job->job_id}}</label></b></td>
            <td class="newtable" style="font-size:15px;" ><b>{{date_format($job->created_at,"d/m/Y")}}</b></td>
            <td class="newtable" style="font-size:16px;" align="right">{{$client->country}}</td>
            </tr>
        </tbody>
    </table>
    <br><br>
    <table >
        <thead style="border-bottom:3pt solid black;color:#3092C3;">
            <tr >
                <td><b>#</b></td>
                <td><b>Task Desciription</b></td>
                <td><b>Rate</b></td>
                <td><b>Qty</b></td>
                <td><b>Total</b></td>
            </tr>
        </thead>
        <tbody style="border-bottom:0pt solid grey;">   
        @php
            $i = 0;
        @endphp
        @foreach($devices as $item)
        <tr>
            <td>{{number_format($i)}}</td>
            <td width="200">{{ $brand.'-'.$serial.'-'.$item['item_type'].'-'.$item['item_capacity']}}</td>
            <td>RO {{number_format($price,3,'.','')}}</td>
            <td>1</td>
            <td>RO {{number_format($price,3,'.','')}}</td>
        </tr>
        @endforeach
        @php
            $i ++;
        @endphp
        </tbody>
    </table>
    <hr /><br>
    <div align="right">
        <label style="font-size:16px;">Sub Total</label>
        <label style="font-size:16px;padding-left:8em;">RO {{number_format($total_price,3,".","")}}</label><br>
    </div><br>
    <div align="right" >
        <label style="background-color:#1483BB;color:white;font-size:20px;margin-top:5px;margin-bottom:5px;">Grand Total</label>
        <label style="background-color:#1483BB;color:white;font-size:20px;padding-left:4em;padding-top:5px;padding-bottom:5px;">RO {{ number_format($total_price,3,".","")}}</label><br>
    </div>
    <br><br><br><br><br>
    <div>
        <table style="border-bottom:0pt solid grey;width:100%">
            <tbody style="font-size:15px;">
                <tr>
                <td class="newtable"><b><label style="font-size:17px;font-family: Times New Roman;">Payment Methods</label></b></td>
                <td class="newtable" style="font-size:17px;" align="right">Prepared By</td>
                </tr>
                <tr>
                <td class="newtable"><label style="font-size:12px;">*We accept Cash, Visa, Master Card & Cheque</label></td>
                <td class="newtable" style="font-size:17px;" align="right">#{{$job->user_name}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <div align="left">
        <label style="font-size:12px;">Please make cheque payment to:</label><br>
        <b><label style="font-size:12px;color:#3092C3;">Salman Mohammad Ashraf Trdg & Cotg.</label><br></b>
        <label style="font-size:12px;">217-011519-001 | HSBC BANK OMAN S.A.O.G</label><br>
    </div>
    <br>
    <div align="left">
        <b><label style="font-size:15px;font-family: Times New Roman;">TERMS & CONDITION</label><br></b>
        <label style="font-size:12px;">50% advance to start the service</label><br>
        <label style="font-size:12px;">50% upon completion</label><br>
    </div>
    <div align="right">
        <b><label style="font-size:22px;color:#3092C3;">Thank you</label><br></b>
        <b><label style="font-size:22px;color:#3092C3;">For Your Enquiry!</label><br></b>
    </div>
</body>
</html>
