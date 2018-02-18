<?php 
mb_internal_encoding('UTF-8');

$rootDIR = __DIR__;

class primal {
    private static $admin = false;
    private static $dbchange = false;
    private static $dblocation = '/../data.json';
    public static $cmslocation = '/';
    public static $dirtheme = '../themes/safari/';
    
    private static $db = [];
    public static $curentpage = '';
    
	public static function init() {
        
        if ( isset($_SESSION['admin']) ) {
			self::$admin = true;
		}
        
        self::$db = self::getDb();
        
        if ( $page = isset( $_GET['page'] ) && $_GET['page'] != 'index.php') {
			$requestedpage = self::makeMeSafe( $_GET['page'] );
            if ( isset( self::$db['pages'][$requestedpage]['active'] ) ) {
                self::$curentpage = $requestedpage;
            } else {
                // Not found supage
                self::$curentpage = '404';
            }
		} else {
            // Home page
            self::$curentpage = self::$db['indexpage'];    
        }
        
        
        
        if (isset($_GET['action'])) {
            $action = self::makeMeSafe( $_GET['action'] );
            
            if ($action == 'page_update') {                
                // Saving blocks
                $blocks = explode(",", $_POST['blockkeys']);
                foreach($blocks as $block) {
                    self::$db['pages'][self::$curentpage]['block'][$block] = $_POST[$block];
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
                    $responseJSON['text'] = 'Strona została zaktualizowana. <i class="primal-icon-cloud"></i>';
                    
//                    echo 'errpr';
                    echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);
                }
                
                self::saveDb(); 
//                header('Location: index.php?page='.self::$curentpage);
            }
            
            if ($action == 'global_update') {
                // Saving blocks
                $blocks = explode(",", $_POST['templateBlocks']);
                
                 foreach($blocks as $block) {
                    self::$db['siteblock'][$block] = $_POST[$block];
                    self::saveDb(); 
                    header('Location: index.php?global=true');
                }
            }
        } else {
            
            if ( isset($_GET['global']) ) {
                echo 'TEST';
//                self::renderBackendToGlobal( ); 
            } else {
                self::renderFrontendPage( );
            }
            
            
        }
           
    }
    
    private static function makeMeSafe( $text ) {
        $text = trim($text);
        return $text;
    } 
    
    /* Database */ 
        private static function getDb() {
            if ( file_exists( __DIR__.self::$dblocation ) ) {
                return json_decode( file_get_contents( __DIR__.self::$dblocation ) , true );
            } else {
                echo 'No data!';
                return false;
            }
            return file_exists( __DIR__.self::$cmslocation.self::$dblocation ) ? json_decode( file_get_contents( __DIR__.self::$dblocation ) ) : false;
        }

        private static function saveDb() {
            self::$db['updated'] = date("Y-m-d H:i:s");
            $dataJSON = json_encode( self::$db , JSON_UNESCAPED_UNICODE);
            file_put_contents( __DIR__.self::$dblocation , $dataJSON);
        }
    
    /* Rendering front pages */
    private static function renderFrontendPage( ) {
        $page = self::$curentpage;
        
        
        $pagedata = self::$db['pages'][$page];
        
        $templatelocation = __DIR__.self::$cmslocation.self::$dirtheme.'template/'.$pagedata['template'].'.php';         
        $admincachelocation = __DIR__.self::$cmslocation.'cache/'.$pagedata['url'].'.php';
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
    
    private static function adminPanel( $templateWithContent ) {
        
        $subpage_template = file_get_contents( __DIR__.self::$cmslocation.'/template/subpage_fields.php' );
        
        $templateWithContent = str_replace("</body>", $subpage_template."</body>", $templateWithContent);
        
        
        
        return $templateWithContent;
    }
    
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
        $phpVars .= ' $dirtheme="'.self::$cmslocation.self::$dirtheme.'"; ';
        $phpVars .= ' $template="'.$pagedata['template'].'"; ';
        $phpVars .= ' $siteblocks=\''.json_encode( self::$db['siteblock'] , JSON_UNESCAPED_UNICODE).'\'; $siteblock=json_decode( $siteblocks , true ); ';
        $phpVars .= ' $blocks=\''.json_encode( $pagedata['block'] , JSON_UNESCAPED_UNICODE).'\'; $block=json_decode( $blocks , true ); ';
        
        
        /* Admin fields */
        $phpVars .= ' $availableTemplatesArray=\''.json_encode( self::getAvailableTemplates() , JSON_UNESCAPED_UNICODE).'\'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ';
        $phpVars .= ' ?>';
        
        $templateString = $phpVars.$templateString;
        
        $templateString = str_replace("(sitename)", self::$db['sitename'], $templateString);
        $templateString = str_replace("(title)", $pagedata['title'], $templateString);
        $templateString = str_replace("(metadescription)", $pagedata['metadescription'], $templateString);
        $templateString = str_replace("(url)", $page, $templateString);
        $templateString = str_replace("(dirtheme)", self::$cmslocation.self::$dirtheme, $templateString);
        $templateString = str_replace("(template)", $pagedata['template'], $templateString);
        
        /* CMS template standard */
            $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 

            /* Page blocks */
            $blocks = '/\(block[^\)]+[name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (block name='')
            $templateString = preg_replace_callback($blocks, 'self::generateInputsWithContent', $templateString);
        
            /* Global blocks */
            $blocks = '/\(siteblock[^\)]+[name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (siteblock name='')
            $templateString = preg_replace_callback($blocks, 'self::generateInputsWithContent', $templateString);
        
        return $templateString;
    }	
    
    private static function generateInputsWithContent( $matches ) {  
        $blockcode = $matches[0];
        if ( !isset($_GET['global']) && isset( self::$db['pages'][self::$curentpage]['block'][$matches[1]] ) ) {
            /* There is data for this block */
            $blockcontent = self::$db['pages'][self::$curentpage]['block'][$matches[1]];
        } else {
            /* No data */
            $blockcontent = '';
        }
        return self::cmsTagCodeParams( $blockcode, $blockcontent );
    }
    
    private static function cmsTagCodeParams( $cmstagcode, $blockcontent ) {        
        $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 
        preg_match('/ (name|id|code)=\'('.$allowedNames.')\'/', $cmstagcode , $matches);  
        if ( !empty($matches[1]) ) {
            
            $tagCode = $matches[2];
        }        
        
        preg_match('/ type=\'([a-zA-Z]+)\'/', $cmstagcode , $matches);
        if ( !empty($matches[1]) ) {
            $tagType = $matches[1];
        } else {
            $tagType = 'regular';
        }
        
        
        return '<div id="cms-field-'.$tagCode.'" class="wysiwyg '.$tagType.'"  data-wysiwyg-key="'.$tagCode.'" data-block-update="false">'.$blockcontent.'</div>';
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
    
    private static function getAvailableTemplates () {
        $filesInDir = scandir(__DIR__.self::$cmslocation.self::$dirtheme.'/template/');
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