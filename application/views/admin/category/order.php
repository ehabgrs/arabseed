<section>
    <h2>Order categories</h2>
    <p class="alert alert-info">Drag to order Categories and then click save</p>
    <div id="message"  role="alert"></div>
    <div id="order_result"></div>
    <input type="button" id="save" value="save" class="btn btn-primary">
</section>

<script type="text/javascript">
    
$(function(){
    //to set get the data first without send anything
    $.post("<?= site_url('admin/category/order_ajax')?>" , {} , function(data){
        $('#order_result').html(data);
    });
    
   $('#save').click(function(){
       
        //nestedSortable('toArray');  is built in function inside nestedSortable liberary to bring the result after we sort it in array
       sorted_list = $('.sortable').nestedSortable('toArray'); 
       
       $.post("<?= site_url('admin/category/order_ajax')?>" ,{sorted_data : sorted_list},function(data){
            $('#order_result').html(data);
            $('#message').addClass('alert alert-success').text('the list has been updated successfully');
       });
      
   });
    
});
</script>