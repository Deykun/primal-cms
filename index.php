<?php 
mb_internal_encoding('UTF-8');

$rootDIR = __DIR__;

class primal {
    private static $admin = false;
    private static $dbchange = false;
    
    private static $dblocation =  "/data.json";
    public static $cmslocation = '';
    public static $dirtheme = '/themes/safari/';
    private static $db = [];
    public static $curentpage = '';
    
	public static function init() {
        
        if ( isset($_SESSION['admin']) ) {
			self::$admin = true;
		}
        
        self::$db = self::getDb();
        
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
        
        self::renderFrontendPage( );
        
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
        
        
        $templatelocation = __DIR__.self::$dirtheme.'template/'.$pagedata['template']. '.php';        
        $cachelocation = __DIR__.'/cache/'.$pagedata['url']. '.php';  
        
        if ( file_exists( $cachelocation ) && $pagedata['cache'] == 1 && isset($pagedata['cached']) ) {
            $update_time = new DateTime($pagedata['updated']);
            $cache_time = new DateTime($pagedata['cached']);
            
        
            
            //Nothing change
            if ($update_time < $cache_time) {
                $cachedtemplate = file_get_contents( $cachelocation );
                echo $cachedtemplate;
//                echo '<hr>';
//                echo 'CACHE';
                return;
            }
        }
		
        if ( file_exists( $templatelocation ) ) {
            $template = file_get_contents( $templatelocation );
            $templateWithContent = self::replaceTagsWithContent($template, $pagedata);
                
            file_put_contents( $cachelocation , $templateWithContent );          
            
            if ($pagedata['cache'] == 1) {
                self::$db['pages'][$pageurl]['cached'] = date("Y-m-d H:i:s");
                self::saveDb();   
            }
            require_once( $cachelocation ); 
//            echo '<hr>';
//            echo 'RENDER';
            return;
        }
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
            $templateString = preg_replace_callback($blocks, 'self::putContentInBlocks', $templateString);
        
            /* Global blocks */
            $blocks = '/\(siteblock[^\)]+[name|id|code]=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (siteblock name='')
            $templateString = preg_replace_callback($blocks, 'self::putContentInSiteblocks', $templateString);
        
        return $templateString;
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
    
}
    
primal::init();

?>