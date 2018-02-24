<?php 
mb_internal_encoding('UTF-8');

/*

██████╗ ██████╗ ██╗███╗   ███╗ █████╗ ██╗       ██████╗███╗   ███╗███████╗
██╔══██╗██╔══██╗██║████╗ ████║██╔══██╗██║      ██╔════╝████╗ ████║██╔════╝
██████╔╝██████╔╝██║██╔████╔██║███████║██║█████╗██║     ██╔████╔██║███████╗
██╔═══╝ ██╔══██╗██║██║╚██╔╝██║██╔══██║██║╚════╝██║     ██║╚██╔╝██║╚════██║
██║     ██║  ██║██║██║ ╚═╝ ██║██║  ██║███████╗ ╚██████╗██║ ╚═╝ ██║███████║
╚═╝     ╚═╝  ╚═╝╚═╝╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝  ╚═════╝╚═╝     ╚═╝╚══════╝

*/


class primal {
    private static $admin = false;
    private static $dirtheme = '/themes/safari/';
    private static $user = 'admin';
    private static $password = 'password';
    private static $cmscatalog = '/'; // site.com → '/', site.com/blog → '/blog/'
    private static $theme = 'safari';
    private static $minifyHTML = true;

    private static $db = [];
    public static $curentpage = '';    
    
	public static function init() {
        
        if ( isset($_SESSION['admin']) ) {
			self::$admin = true;
		}
        
        self::$db = self::getDataFromJSON();
        
        if ( $page = isset( $_GET['page'] ) && $_GET['page'] != 'index.php') {
			$requestedpage = self::makeMeSafe( $_GET['page'] );
            if ( isset( self::$db['pages'][$requestedpage]['active'] ) && self::$db['pages'][$requestedpage]['active'] == 1 ) {
                self::$curentpage = $requestedpage;
            } else {
                // Not found supage
                self::$curentpage = '404';
            }
		} else {
            // Home page
            self::$curentpage = self::$db['indexpage'];    
        }
        
        
        if ( self::$admin == true ) {
            if (isset($_GET['action'])) {
            $action = self::makeMeSafe( $_GET['action'] );
                if ($action == 'page_update') {                
                    // Saving blocks                
                    if ( isset($_POST['blockkeys']) ) {
                        $blocks = explode(",", $_POST['blockkeys']);
                        foreach($blocks as $block) {
                            self::$db['pages'][self::$curentpage]['block'][$block] = $_POST[$block];
                        }
                    }
                    if ( isset($_POST['siteblockkeys']) ) {
                        $siteblocks = explode(",", $_POST['siteblockkeys']);
                        foreach($siteblocks as $siteblock) {
                            self::$db['siteblock'][$siteblock] = $_POST[$siteblock];
                        }
                    }

                    self::$db['pages'][self::$curentpage]['title'] = (isset($_POST['title'])) ? $_POST['title'] : self::$db['pages'][self::$curentpage]['title'];

                    self::$db['pages'][self::$curentpage]['active'] = (isset($_POST['active'])) ? 1 : 0;
                    self::$db['pages'][self::$curentpage]['cache'] = (isset($_POST['cache'])) ? 1 : 0;

                    self::$db['pages'][self::$curentpage]['template'] = (isset($_POST['template'])) ? $_POST['template'] : self::$db['pages'][self::$curentpage]['template'];

                    self::$db['pages'][self::$curentpage]['metadescription'] = (isset($_POST['metadescription'])) ? $_POST['metadescription'] : '';
                    self::$db['pages'][self::$curentpage]['menu_name'] = (isset($_POST['menu_name'])) ? $_POST['menu_name'] : self::$db['pages'][self::$curentpage]['menu_name'];

                    self::$db['pages'][self::$curentpage]['updated'] = date("Y-m-d H:i:s");


                    if ( $_POST['ajax'] ) {
                        $responseJSON = [];   
                        $responseJSON['status'] = 'success';
                        $responseJSON['text'] = 'Strona została zaktualizowana. <i class="primal-icon-download"></i>';
                        
                        echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);
                    }

                    self::saveDataToJSON(); 
                }
            } else {
                self::renderBackendPage( );   
            }
		} else {
            self::renderFrontendPage( );
        }
        
        
        /* Debugowanie */
//        echo self::$db['sitename'];
//        echo '<br>';
//        echo self::$db['updated'];
        
//        echo '<pre>';
//        print_r(self::$db);
//        echo '</pre>';
        
    }
    
    private static function makeMeSafe( $text ) {
        $text = trim($text);
        return $text;
    }
    
    
/*

         ██╗███████╗ ██████╗ ███╗   ██╗
         ██║██╔════╝██╔═══██╗████╗  ██║
         ██║███████╗██║   ██║██╔██╗ ██║
    ██   ██║╚════██║██║   ██║██║╚██╗██║
    ╚█████╔╝███████║╚██████╔╝██║ ╚████║
     ╚════╝ ╚══════╝ ╚═════╝ ╚═╝  ╚═══╝

*/
        private static function getDataFromJSON() {
            if ( file_exists( 'data.json' ) ) {
                return json_decode( file_get_contents( 'data.json' ) , true );
            } else {
                echo 'No data!';
                return false;
            }
        }

        private static function saveDataToJSON() {
            self::$db['updated'] = date("Y-m-d H:i:s");
            $dataJSON = json_encode( self::$db , JSON_UNESCAPED_UNICODE);
            file_put_contents( 'data.json' , $dataJSON);
        }
    
    
/*

    ██████╗ ███████╗███╗   ██╗██████╗ ███████╗██████╗ 
    ██╔══██╗██╔════╝████╗  ██║██╔══██╗██╔════╝██╔══██╗
    ██████╔╝█████╗  ██╔██╗ ██║██║  ██║█████╗  ██████╔╝
    ██╔══██╗██╔══╝  ██║╚██╗██║██║  ██║██╔══╝  ██╔══██╗
    ██║  ██║███████╗██║ ╚████║██████╔╝███████╗██║  ██║
    ╚═╝  ╚═╝╚══════╝╚═╝  ╚═══╝╚═════╝ ╚══════╝╚═╝  ╚═╝
    
*/
    
        private static function replaceTagsWithContent( $templateString ) {
        $page = self::$curentpage;    
        $pagedata = self::$db['pages'][$page];  
        
        /* PHP vars available in template */
        $phpVars = '<?php ';
        $phpVars .= ' $sitename="'.self::$db['sitename'].'"; ';
        $phpVars .= ' $title="'.$pagedata['title'].'"; ';
        $phpVars .= ' $metadescription="'.$pagedata['metadescription'].'"; ';
        $phpVars .= ' $active='.$pagedata['active'].'; ';
        $phpVars .= ' $cache='.$pagedata['cache'].'; ';
        $phpVars .= ' $menu_name="'.$pagedata['menu_name'].'"; ';
        $phpVars .= ' $url="'.$page.'"; ';
        $phpVars .= ' $cmscatalog="'.self::$cmscatalog.'"; ';
        $phpVars .= ' $themecatalog="'.self::$cmscatalog.'themes/'.self::$theme.'/"; ';
        $phpVars .= ' $template="'.$pagedata['template'].'"; ';
        $phpVars .= ' $siteblocks=\''.json_encode( self::$db['siteblock'] , JSON_UNESCAPED_UNICODE).'\'; $siteblock=json_decode( $siteblocks , true ); ';
        $phpVars .= ' $blocks=\''.json_encode( $pagedata['block'] , JSON_UNESCAPED_UNICODE).'\'; $block=json_decode( $blocks , true ); ';
        
        $templateString = str_replace("(sitename)", self::$db['sitename'], $templateString);
        $templateString = str_replace("(title)", $pagedata['title'], $templateString);
        $templateString = str_replace("(metadescription)", $pagedata['metadescription'], $templateString);
        $templateString = str_replace("(url)", $page, $templateString);
        $templateString = str_replace("(cmscatalog)", self::$cmscatalog, $templateString);
        $templateString = str_replace("(themecatalog)", self::$cmscatalog.'themes/'.self::$theme.'/', $templateString);
        $templateString = str_replace("(template)", $pagedata['template'], $templateString);
        
        
        $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 
        
        if (self::$admin == true) {
            /* Page blocks */
            $blocks = '/\(block[^\)]+[key|name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (block key='')
            $templateString = preg_replace_callback($blocks, 'self::generateInputsWithContent', $templateString);
        
            /* Global blocks */
            $siteblocks = '/\(siteblock[^\)]+[key|name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (siteblock key='')
            $templateString = preg_replace_callback($siteblocks, 'self::generateInputsWithContent', $templateString);
            
            
            /* Admin vars */
            $phpVars .= ' $admin=true; ';
            $phpVars .= ' $availableTemplatesArray=\''.json_encode( self::getAvailableTemplates() , JSON_UNESCAPED_UNICODE).'\'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ';
        } else {
            /* Page blocks */
            $blocks = '/\(block[^\)]+[key|name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (block name='')
            $templateString = preg_replace_callback($blocks, 'self::putContentInBlocks', $templateString);
        
            /* Global blocks */
            $blocks = '/\(siteblock[^\)]+[key|name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (siteblock name='')
            $templateString = preg_replace_callback($blocks, 'self::putContentInSiteblocks', $templateString);
            
            $phpVars .= ' $admin=false; ';
        }
        
        $phpVars .= ' ?>';
        $templateString = $phpVars.$templateString;
            
            
        if (self::$minifyHTML == true ) {
            $templateString = preg_replace('/\s+/', ' ',$templateString);
        }
        
        return $templateString;
    }
    
    
/*

    ███████╗██████╗  ██████╗ ███╗   ██╗████████╗
    ██╔════╝██╔══██╗██╔═══██╗████╗  ██║╚══██╔══╝
    █████╗  ██████╔╝██║   ██║██╔██╗ ██║   ██║   
    ██╔══╝  ██╔══██╗██║   ██║██║╚██╗██║   ██║   
    ██║     ██║  ██║╚██████╔╝██║ ╚████║   ██║   
    ╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   

*/
    
    
    /* Rendering front pages */
    private static function renderFrontendPage( ) {
        $page = self::$curentpage;
        
        $pagedata = self::$db['pages'][$page];
        
        $templatelocation = 'themes/'.self::$theme.'/template/'.$pagedata['template']. '.php';        
        $cachelocation = 'cache/'.$pagedata['url']. '.php';  
        
        if ( file_exists( $cachelocation ) && $pagedata['cache'] == 1 && isset($pagedata['cached']) ) {
            $update_time = new DateTime($pagedata['updated']);
            $cache_time = new DateTime($pagedata['cached']);
            
            //Nothing change
            if ($update_time < $cache_time) {
                $cachedtemplate = file_get_contents( $cachelocation );
                require_once( $cachelocation ); 
                echo '<hr>';
                echo 'CACHE';
                return;
            }
        }
		
        if ( file_exists( $templatelocation ) ) {
            $template = file_get_contents( $templatelocation );
            $templateWithContent = self::replaceTagsWithContent($template, $pagedata);
                
            file_put_contents( $cachelocation , $templateWithContent );          
            
            if ($pagedata['cache'] == 1) {
                self::$db['pages'][self::$curentpage]['cached'] = date("Y-m-d H:i:s");
                self::saveDataToJSON();   
            }
            require_once( $cachelocation ); 
            echo '<hr>';
            echo 'RENDER';
            return;
        }
    }	
    
    private static function putContentInBlocks( $matches ) {
        
        if ( isset( self::$db['pages'][self::$curentpage]['block'][$matches[1]] ) ) {
            /* There is data for this block */
            $dataToPutInBlock = self::$db['pages'][self::$curentpage]['block'][$matches[1]];
            
            
            /* Only digits */
            if (strpos($matches[0], 'modifer=\'digits\'') !== false) {
                $dataToPutInBlock = preg_replace('/\D/', '', $dataToPutInBlock);
            }
            
            return $dataToPutInBlock;
            
        } else {
            /* No data */
            return '';
        }
    }
    
    private static function putContentInSiteblocks( $matches ) {
        
        
        if ( isset( self::$db['siteblock'][$matches[1]] ) ) {
            /* There is data for this block */
            $dataToPutInBlock = self::$db['siteblock'][$matches[1]];
            
            /* Only digits */
            if (strpos($matches[0], 'modifer=\'digits\'') !== false) {
                $dataToPutInBlock = preg_replace('/\D/', '', $dataToPutInBlock);
            }
            
            return $dataToPutInBlock;
        } else {
            /* No data */
            return '';
        }
    }

/*
    
     █████╗ ██████╗ ███╗   ███╗██╗███╗   ██╗
    ██╔══██╗██╔══██╗████╗ ████║██║████╗  ██║
    ███████║██║  ██║██╔████╔██║██║██╔██╗ ██║
    ██╔══██║██║  ██║██║╚██╔╝██║██║██║╚██╗██║
    ██║  ██║██████╔╝██║ ╚═╝ ██║██║██║ ╚████║
    ╚═╝  ╚═╝╚═════╝ ╚═╝     ╚═╝╚═╝╚═╝  ╚═══╝
                                        
*/                               
      
    private static function renderBackendPage( ) {
        $page = self::$curentpage;
        
        $pagedata = self::$db['pages'][$page];
        
        $templatelocation = 'themes/'.self::$theme.'/template/'.$pagedata['template']. '.php';
        $admincachelocation = 'admincache/'.$pagedata['url']. '.php';
        
        if ( file_exists( $templatelocation ) ) {
            $template = file_get_contents( $templatelocation );
            $templateWithContent = self::replaceTagsWithContent($template, $pagedata);
            
            $templateWithContent = self::adminPanel($templateWithContent);
                
            file_put_contents( $admincachelocation , $templateWithContent );          
            

            require_once( $admincachelocation ); 
//            echo '<hr>';
//            echo 'RENDER - admin';
            return;
        }
    }
    
    private static function generateInputsWithContent( $matches ) {  
        $blockcode = $matches[0];
        if (strpos($blockcode, '(block') !== false) {
            
            if ( isset( self::$db['pages'][self::$curentpage]['block'][$matches[1]] ) ) {
                $content = self::$db['pages'][self::$curentpage]['block'][$matches[1]];
            } else {
                $content = '';
            }
            
            return self::cmsTagCodeParams( $blockcode, 'block', $content );
        }
        
        if (strpos($blockcode, '(siteblock') !== false) {
            
            if ( isset( self::$db['siteblock'][$matches[1]] ) ) {
                $content = self::$db['siteblock'][$matches[1]];
            } else {
                $content = '';
            }
            
            return self::cmsTagCodeParams( $blockcode, 'siteblock', $content );
        }
    }
    
    private static function cmsTagCodeParams( $cmstagcode, $type, $blockcontent = ''  ) {        
        $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 
        preg_match('/ (key|name|id|code)=\'('.$allowedNames.')\'/', $cmstagcode , $matches);  
        if ( !empty($matches[1]) ) {
            
            $tagCode = $matches[2];
        }        
        
        preg_match('/ type=\'([a-zA-Z]+)\'/', $cmstagcode , $matches);
        if ( !empty($matches[1]) ) {
            $tagType = $matches[1];
        } else {
            $tagType = 'regular';
        }
        
        
        return '<div id="cms-field-'.$tagCode.'" class="wysiwyg '.$tagType.'"  data-'.$type.'-key="'.$tagCode.'" data-block-update="false">'.$blockcontent.'</div>';
    }
    
     private static function adminPanel( $templateWithContent ) {
        
        $subpage_template = file_get_contents( 'admin/template/subpage_fields.php' );
         
        $templateWithContent = str_replace("</body>", $subpage_template."</body>", $templateWithContent);
        
        return $templateWithContent;
    }
    
    private static function getAvailableTemplates () {
        $filesInDir = scandir('themes/'.self::$theme.'/template/');
        
        $templates = [];
        foreach($filesInDir as $file) {
            if (preg_match('/(.php|.html|.txt)$/', $file)) {
                $templateName = preg_replace('/(.php|.html|.txt)$/', '', $file);
                $templates[$templateName] = $templateName;
            }
        }
        return $templates;
    }
    
}


    
primal::init();

?>