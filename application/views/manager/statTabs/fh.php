<div class="boxheading toprounded-4px" style="">
    Menu Item Hourly Frequency
</div>
<div class="singlecontent padding-10px">
<table  id="t2" class="table  table-striped  table-hover table-autosort table-autofilter table-autopage:10 table-stripeclass:alternate table-page-number:t2page table-page-count:t2pages table-filtered-rowcount:t2filtercount table-rowcount:t2allcount">
<thead>
    <tr>    
    <th class="table-filterable table-sortable:date" style="text-align: center" >Day</th>
    <th class="table-filterable table-sortable:numeric" style="text-align: center">#Of Menu Items</th>
    <th class="table-filterable table-sortable:default" style="text-align: center">Name</th>
    </tr>
</thead>
<tbody>
<?php
$this->load->model('statistics_model');

//.date("Y-m-j",strtotime($date)).
foreach(statistics_model::frequency_hourly() as $data){
    echo       "
        <tr >
        <td  style='text-align: center'>$data->time_constraint</td>
        <td  style='text-align: center'>$data->number</td>
        <td  style='text-align: center'>".substr($data->name,0,20)."</td>
        </tr>
        ";
}
  
///alt\
?>

</tbody>
<tfoot>
<tr>

</tr>
<tr><td colspan="6"><div id="paging" style="text-align: center">
            
<a  class="table-page:previous" style="cursor:pointer;"><span>&lt; &lt; Previous</span></a>
<a  colspan="3" style="text-align:center;">Page <span id="t2page"></span>&nbsp;of <span id="t2pages"></span></a>
<a class="table-page:next" style="cursor:pointer;"><span>Next &gt; &gt;</span></a>
</div></tr>
<tr>
<td colspan="5" style="text-align: center">
    <span id="t2filtercount"></span>&nbsp;of <span id="t2allcount"></span>&nbsp;rows match filter(s)
</td>
</tr>
<tr>
<td colspan="5" style="text-align: right">
<a target="_blank" href="<?php echo site_url()?>/manager/pdf/fh"> 
    <font size="2">Download Me</font>
 
    <img style="width: 30px"src="<?php echo base_url()?>/assets/img/pdf.png"/>  
</a>  
</td>
</tr>
</tfoot>
</table>
</div>
