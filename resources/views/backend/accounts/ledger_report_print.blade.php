<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Report Print</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta charset="UTF-8">
	<style media="all">
        @page {
			margin: 0;
			padding:0;
		}
		body{
			font-size: 0.575rem !important;
            font-weight: normal;
			padding:0;
			margin:0; 
		}
		.gry-color *,
		.gry-color{
			color:#000;
		}
		table{
			width: 100%;
		}
		table th{
			font-weight: normal;
		}
		table.padding th{
			padding: .25rem .7rem;
		}
		table.padding td{
			padding: .25rem .7rem;
		}
		table.sm-padding td{
			padding: .1rem .7rem;
		}
		.border-bottom td,
		.border-bottom th{
			border-bottom:1px solid #eceff4;
		}
		.text-left{
			text-align:left;
		}
		.text-right{
			text-align:right;
		}
	</style>
</head>
<body>
	<div>


		<div style="background: #eceff4;padding: 0px 20px;">
			<div style="font-size: 1.8rem;
			display: flex;
			justify-content: center">{{ get_setting('site_name')->value }}</div>
			<table>
				<tr>
					{{-- <td style="font-size: 1rem;" class="text-right strong">INVOICE</td> --}}
				</tr>
			</table>
			<table>
				
				<tr>
					<td style="text-align: center">{{ get_setting('business_address')->value }}</td>
				</tr>
				<tr>
					<td class="text-center" style="text-align: center">Phone: {{ get_setting('phone')->value }}</td>
				</tr>
				
			</table>
			<hr>
		</div>

	    <div style="padding: 0px 20px;">
			<table id="example" class="padding text-left small border-bottom">
				<thead>
	                <tr class="gry-color" style="background: #eceff4;">
	                    <th width="35%" class="text-left" style="font-weight: 600;">Account Head</th>
	                    <th width="10%" class="text-left" style="font-weight: 600;">Particulars</th>
	                    <th width="15%" class="text-left" style="font-weight: 600;">Created At</th>
	                    @if($account  == 'debit')
	                    <th width="15%" class="text-right" style="font-weight: 600;">Deposit</th>
	                    @else
	                    <th width="15%" class="text-right" style="font-weight: 600;">Expense</th>
	                    @endif
	                    <th width="15%" class="text-right" style="font-weight: 600;">Balance</th>
	                </tr>
				</thead>
				<tbody>
                    @foreach($account_ledgers as $key => $ledger)
                    <tr>
                        <td> {{ $key+1}} </td>
                        <td> {{ $ledger->account_head->title ?? '' }} </td>
                        <td> {{ $ledger->particulars }} </td>
                        <td> {{ date_format(date_create($ledger->created_at),"Y/m/d" ) }} </td>
                        @if($account  == 'debit')
                            <td> {{ $ledger->credit }} </td>
                        @else
                            <td> {{ $ledger->debit }} </td>
                        @endif
                        <td> {{ $ledger->balance }} </td>
                    </tr> 
                    @endforeach
                </tbody>
                @if($account_ledgers->count() > 0 )
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-center"></td>
                            @if($account  == 'debit')
                                <td >Sum : {{$account_ledgers->sum('credit')}}</td>
                            @else
                                <td >Sum : {{$account_ledgers->sum('debit')}}</td>
                            @endif
                            <td >Balance : {{ $ledger->balance }}</td>
                            <td colspan="7"></td>
                        </tr>
                    </tfoot>
                @endif
			</table>
		</div>
	</div>
</body>
</html>

<script>
    window.onload = function() {
        window.print();
    };
</script>