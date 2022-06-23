<?php 
echo get_nested_list($nested_data);

function get_nested_list($array, $child = FALSE)
{
    $str ='';
    
    if($array){
        $str = $child == FALSE ? '<ol class="sortable">' : '<ol>';
        
        foreach($array as $item) {
            $str .= '<li id="list_'.$item['id'].'">';
            $str .= '<div>' . $item['name'] . '</div>';
            
            if(isset($item['children']) && count($item['children'])) {
                $str .= get_nested_list($item['children'], TRUE);
            }
            
            $str .= '</li>'.PHP_EOL;
        }
        $str .= '</ol>' . PHP_EOL;
    }
    
    return $str;
    
}
?>

  <script type="text/javascript">
    $(document).ready(function(){
        $('.sortable').nestedSortable({
            handle : 'div',
            items : 'li',
            toleranceElement: '>div',
            maxLevels : 2
        });
    
    });
      
   </script>