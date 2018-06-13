<?php 
    if (!function_exists('menuHTML')) {
       function menuHTML( $menu ) {
            $menuHTML = '<ul>';
            foreach( $menu as $key => $element ) {

                /* Paramaters */
                $elementClass = '';
                $target = '';
                $rel = '';

                if ( isset($element['active']) ) { $elementClass .= 'active '; }
                if ( isset($element['target']) ) { $target = ' target="'.$element['target'].'" '; } 
                if ( isset($element['rel']) ) { $rel = ' rel="'.$element['rel'].'" '; } 

                $elementHTML = '<li>';
                $elementHTML .= '<a href="'.$element['url'].'" class="'.$elementClass.'" '.$rel.' '.$target.'>';
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
    } 

    echo menuHTML( $menu[$key['menu']] );
?>




