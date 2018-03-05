<?php 

    function menuHTML( $menu ) {
        $menuHTML = '<ul>';
        foreach( $menu as $key => $element ) {
            
            
            /* Paramaters */
            $elementClass = '';
            $target = '';
            
            if ( isset($element['active']) ) { $elementClass .= 'active '; }
            if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } 
            
            $elementHTML = '<li>';
            $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$target.'>';
            $elementHTML .= $element['name'];
            $elementHTML .= '</a>';
            
            if ( isset( $element['menu'] ) ) {
                $elementHTML .= menuHTML( $element['menu'] );
            }
            
            
            $elementHTML .= '</li>';
              
            $menuHTML .= $elementHTML;
        }
        
        $menuHTML .= '</ul>';
        
        return $menuHTML;
    }

    echo menuHTML( $menu[0] );

    /*echo '<pre>';
    print_r($menu);
    echo '</pre>';*/
?>




