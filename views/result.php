<table style="width:100%; font-size:small; margin:10px 0; border-collapse:collapse; border:1px solid #CCC;">
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">Test Name</th>
		<td style="border-bottom:1px solid #CCC;"><?=$result["Test Name"]?></td>
	</tr>
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">Test Datatype</th>
		<td style="border-bottom:1px solid #CCC;"><?=$result["Test Datatype"]?></td>
	</tr>
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">Expected Datatype</th>
		<td style="border-bottom:1px solid #CCC;"><?=$result["Expected Datatype"]?></td>
	</tr>
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">Result</th>
		<td style="border-bottom:1px solid #CCC;"><span style="color: #<?=$result["Result"] == "Passed" ? "0C0" : "C00" ?>";><?=$result["Result"]?></span></td>
	</tr>
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">File Name</th>
		<td style="border-bottom:1px solid #CCC;"><?=$result["File Name"]?></td>
	</tr>
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">Line Number</th>
		<td style="border-bottom:1px solid #CCC;"><?=$result["Line Number"]?></td>
	</tr>
	<tr>
		<th style="text-align: left; border-bottom:1px solid #CCC;">Notes</th>
		<td style="border-bottom:1px solid #CCC;"><?=$result["Notes"]?></td>
	</tr>
</table>
