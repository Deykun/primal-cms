<?php 

/*

██████╗ ██████╗ ██╗███╗   ███╗ █████╗ ██╗       ██████╗███╗   ███╗███████╗
██╔══██╗██╔══██╗██║████╗ ████║██╔══██╗██║      ██╔════╝████╗ ████║██╔════╝
██████╔╝██████╔╝██║██╔████╔██║███████║██║█████╗██║     ██╔████╔██║███████╗
██╔═══╝ ██╔══██╗██║██║╚██╔╝██║██╔══██║██║╚════╝██║     ██║╚██╔╝██║╚════██║
██║     ██║  ██║██║██║ ╚═╝ ██║██║  ██║███████╗ ╚██████╗██║ ╚═╝ ██║███████║
╚═╝     ╚═╝  ╚═╝╚═╝╚═╝     ╚═╝╚═╝  ╚═╝╚══════╝  ╚═════╝╚═╝     ╚═╝╚══════╝

Szymon Tondowski - https://github.com/deykun/primal-cms

*/

session_start();
mb_internal_encoding('UTF-8');


class primal {
    private static $debug = false;
    private static $admin = false;
    private static $login = false;
    private static $dirtheme = '/themes/safari/';
    private static $user = 'admin';
    private static $password = 'admin';
    private static $adminSessionHash = 'sjhgsjh';
//    private static $cmscatalog = '/'; // site.com → '/', site.com/blog → '/blog/'
    private static $cmscatalog = '/'; // site.com → '/', site.com/blog → '/blog/'
    private static $theme = 'safari';
    private static $minifyHTML = true; 

    private static $db = [];
    public static $pagekey = '';    
    
	public static function init() {  
        if (isset($_SESSION['pah']) && $_SESSION['pah'] == self::$adminSessionHash) {
			self::$admin = true;
		}
        
        self::$db = self::getDataFromJSON();
        self::$pagekey = self::urlMatch();
                
        
        if ( self::$admin == true ) {
            if (isset($_GET['action'])) {
                $action = self::makeThisSafe( $_GET['action'] );
                self::adminAjaxAction($action);
                die();
            } else {
                self::renderBackendPage( );   
            }
		} else {
            self::renderFrontendPage( );
        } 
        
        /* Debug (on frontend too!) */        
        if (self::$debug == true) {
            echo '<hr> <h3>CONTENT of JSON DATABASE - last update - '.self::$db['updated'].' </h3>';
            echo '<pre>';
            print_r(self::$db);
            echo '</pre>';
        }        
    }
    
    private function urlMatch() {
        $chosenPageAlias = self::$db['homepage'];  // Default home page
        
        /* if subpage was requsted */
        if ( $page = isset( $_GET['page'] ) ) {

            $pages = self::$db['page'];
            $requestedURL = self::makeThisSafe( $_GET['page'] );

            /* login action */
            if ( $requestedURL == 'login' ) {
                $chosenPageAlias = self::$db['homepage'];
                if ( self::$admin == false ) {
                    self::$login = true;
                    if ( isset($_GET['action']) && $_GET['action'] == 'login' ) {
                        self::loginAjaxAction();                        
                        die();
                    }
                }
            } else {
                /* assuming 404 error */
                $chosenPageAlias = '404';

                /* searching for url in pages */
                foreach($pages as $index => $page) {
                    if ($page['url'] == $requestedURL) {
                        $chosenPageAlias = $index;
                        break;
                    }
                } 
            }
        }
        return $chosenPageAlias;
    }
    
    private function loginAjaxAction() {
        $responseJSON = [];   
        $postuser = self::makeThisSafe( $_POST['user'] );
        $postpassword = self::makeThisSafe( $_POST['password'] );
        if ($postuser == self::$user && $postpassword == self::$password) {
            $_SESSION['pah'] = self::$adminSessionHash;

            $responseJSON['status'] = 'success';
            $responseJSON['text'] = 'Zalogowano. Odświeżanie... <i class="primal-icon-refresh"></i>';
            $responseJSON['reload'] = true;
        } else {
            $responseJSON['status'] = 'error';
            $responseJSON['text'] = 'Błędny login lub hasło. <i class="primal-icon-cancel"></i>';                            
        }
        echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);
    }
        
    private static function makeThisSafe( $text ) {
        $text = trim($text);
        return $text;
    }
    
    private static function makeThisSafeHTML( $text ) {
        $text = trim($text);
        $text = str_replace("'", "&#39;", $text);
        $text = str_replace("?", "&#63;", $text);
        
        /* ajax form parser hack - cause < and &lt; in JS encodeURIComponent() are the same */
        $text = str_replace("|<|", "&lt;", $text);
        $text = str_replace("|>|", "&gt;", $text);
        
        return $text;
    }
    
    private static function makeThisSafeURL( $text ) {
        $text = trim($text);
        $text = mb_strtolower($text);
        $text = preg_replace('/\s+/', ' ',$text);
        $text = preg_replace('/\s/', '-',$text);
        $text = preg_replace('~[^a-z0-9-_]+~', '', $text);
        $text = preg_replace('/-+/', '-',$text);        
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
        
        $pagedata = self::$db['page'][self::$pagekey];  
        $page = $pagedata['url'];    
        
        $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 
            
        /* Replacing subtemplates */
        $subtemplates = '/\(subtemplate[^\)]+name=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (subtemplate key='')
        $i = 0;
        do {
            $templateString = preg_replace_callback($subtemplates, 'self::replaceWithSubtemplate', $templateString);
            $i++;
        } while ( preg_match($subtemplates, $templateString) && $i < 10 );
            
        
        /* PHP vars available in template */
        $phpVars = '<?php ';
        $phpVars .= ' $sitename="'.self::$db['sitename'].'"; ';
        $phpVars .= ' $title="'.$pagedata['title'].'"; ';
        $phpVars .= ' $metadescription="'.$pagedata['metadescription'].'"; ';
        $phpVars .= ' $active='.$pagedata['active'].'; ';
        $phpVars .= ' $cache='.$pagedata['cache'].'; ';
        $phpVars .= ' $seoindex='.$pagedata['seoindex'].'; ';
        $phpVars .= ' $menu_name="'.$pagedata['menu_name'].'"; ';
        $phpVars .= ' $url="'.$pagedata['url'].'"; ';
        $phpVars .= ' $cmscatalog="'.self::$cmscatalog.'"; ';
        $phpVars .= ' $themecatalog="'.self::$cmscatalog.'themes/'.self::$theme.'/"; ';
        $phpVars .= ' $template="'.$pagedata['template'].'"; ';
        $phpVars .= ' $siteblocks=\''.json_encode( self::$db['siteblock'] , JSON_UNESCAPED_UNICODE).'\'; $siteblock=json_decode( $siteblocks , true ); ';
        $phpVars .= ' $blocks=\''.json_encode( $pagedata['block'] , JSON_UNESCAPED_UNICODE).'\'; $block=json_decode( $blocks , true ); ';        
        $menus = self::$db['menu'];
        
        $menuPHP = [];
        
        foreach($menus as $menuKey => $menu) {
            $menuPHP[$menuKey] = self::renderMenu( $menu );
        }
        
        $phpVars .= ' $menus=\''.json_encode( $menuPHP , JSON_UNESCAPED_UNICODE).'\'; $menu=json_decode( $menus , true ); ';       
        
        $templateString = str_replace("(sitename)", self::$db['sitename'], $templateString);
        $templateString = str_replace("(title)", $pagedata['title'], $templateString);
        $templateString = str_replace("(metadescription)", $pagedata['metadescription'], $templateString);
        $templateString = str_replace("(url)", $pagedata['url'], $templateString);
        $templateString = str_replace("(cmscatalog)", self::$cmscatalog, $templateString);
        $templateString = str_replace("(themecatalog)", self::$cmscatalog.'themes/'.self::$theme.'/', $templateString);
        $templateString = str_replace("(template)", $pagedata['template'], $templateString);
        
        if (self::$admin == true) {
            /* Page blocks */
            $blocks = '/\(block[^\)]+key=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (block key='')
            $templateString = preg_replace_callback($blocks, 'self::generateInputsWithContent', $templateString);
        
            /* Global blocks */
            $siteblocks = '/\(siteblock[^\)]+key=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (siteblock key='')
            $templateString = preg_replace_callback($siteblocks, 'self::generateInputsWithContent', $templateString);
            
            /* Admin vars */
            $phpVars .= ' $admin=true; ';
            $phpVars .= ' $availableTemplatesArray=\''.json_encode( self::getAvailableTemplates() , JSON_UNESCAPED_UNICODE).'\'; $availableTemplates=json_decode( $availableTemplatesArray , true ); ';
            $phpVars .= ' $homepage="'.self::$db['homepage'].'";';
            $phpVars .= ' $availablePagesArray=\''.json_encode( self::getAvailablePages() , JSON_UNESCAPED_UNICODE).'\'; $availablePages=json_decode( $availablePagesArray , true ); ';
        } else {
            /* Page blocks */
            $blocks = '/\(block[^\)]+key=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (block name='')
            $templateString = preg_replace_callback($blocks, 'self::putContentInBlocks', $templateString);
        
            /* Global blocks */
            $blocks = '/\(siteblock[^\)]+key=\'('.$allowedNames.')\'[^\)]*\)/'; // return name for (siteblock name='')
            $templateString = preg_replace_callback($blocks, 'self::putContentInSiteblocks', $templateString);
            
            $phpVars .= ' $admin=false; ';
        }
        
        $phpVars .= ' ?>';
        $templateString = $phpVars.$templateString;
            
            
        if (self::$minifyHTML == true ) {
            $strip = '/(\(strip\))(.*?)(\(\/strip\))/sm'; // remove whitespaces and linebreakes
            $templateString = preg_replace_callback($strip, 'self::removeSpaces', $templateString);
        } else {
            $templateString = str_replace("(strip)", '', $templateString);
            $templateString = str_replace("(/strip)", '', $templateString);
        }
        
        return $templateString;
    }
    
    private static function replaceWithSubtemplate( $matches ) {
        $subtemplatelocation = 'themes/'.self::$theme.'/template/subtemplate/'.$matches[1]. '.php';           
        if ( file_exists( $subtemplatelocation ) ) {
            /* There is subtemplate for this block */
            $subtemplateString = file_get_contents( $subtemplatelocation );            
            $subtemplateParams = '';
            /* Searching for parameters of subtemplate for example: menu='top' to make $key['menu'] = "top" */
            $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 
            preg_match_all('/ '.$allowedNames.'=\''.$allowedNames.'\'/', $matches[0] , $paramsMatches);  
            if ( count($paramsMatches) > 0) {
                $subtemplateParams = ' <?php $key = []; ';
                foreach($paramsMatches as $index => $param) {
                    preg_match_all('/('.$allowedNames.')=\'('.$allowedNames.')\'/', $matches[0] , $paramMatches);  
                    $paramsTransposition = [];
                    foreach($paramMatches[0] as $index => $param) {
                        $key = $paramMatches[1][$index];
                        $value = $paramMatches[2][$index];
                        
                        if (!empty($key) && !empty($value)) {
                            $subtemplateParams .= ' $key["'.$key.'"] = "'.$value.'"; ';   
                        }
                    }
                } 
                
                $subtemplateParams .= ' ?>';   
            }
            
            $subtemplateString = $subtemplateParams.$subtemplateString;
            

            
            return $subtemplateString;
        } else {
            /* No data */
            return '<?php /* subtemplate '.$matches[1].' was not found */ ?>';
        }
    }
    
    private static function renderMenu( $menu, $checkActive = 0 ) {
        $menuPHP = [];
        $active = false; 
        
        foreach( $menu as $key => $element ) {
            $elementPHP = [];
            
            if ( isset( $element['url'] ) ) {
                $elementPHP['type'] = 'url';
                $elementPHP['url'] = $element['url'];
            }
            
            if ( $element['type'] == 'cms' ) {
                $elementPHP['type'] = 'cms';
                $elementPHP['key'] = $element['key'];
                
                if ( $element['key'] == self::$db['homepage'] ) {
                    $elementPHP['url'] = self::$cmscatalog;
                } else if ( isset( self::$db['page'][ $element['key'] ]['url'] ) ) {
                    $elementPHP['url'] =  self::$cmscatalog.self::$db['page'][ $element['key'] ]['url'];
                } else {
                    $elementPHP['url'] = self::$cmscatalog.'404';
                }
                
                if ( $element['key'] == self::$pagekey ) {
                    $elementPHP['active'] = true;
                    $active = true;
                }
                
                $elementPHP['name'] = isset( self::$db['page'][ $element['key'] ]['menu_name'] ) ? self::$db['page'][ $element['key'] ]['menu_name'] : $element['key'];          
            } else {
                $elementPHP['name'] = $element['name'];
            }

            
            /* Submenu and active from submenu by recursion */
            if ( isset( $element['menu'] ) ) {
                $elementPHP['menu'] = self::renderMenu( $element['menu'] );
                
                if ( !isset( $elementPHP['active'] ) ) {
                    $submenu = self::renderMenu( $element['menu'], 1 );
                    
                    if ( $submenu[1] == true ) {
                        $elementPHP['active'] = true;
                        $active = true;
                    }
                    
                    $elementPHP['menu'] = $submenu[0];                    
                } 
            }
            
            if ( isset( $element['target'] ) ) {
                $elementPHP['target'] = $element['target'];
            }
            
            if ( isset( $element['rel'] ) ) {
                $elementPHP['rel'] = $element['rel'];
            }
            
            
            $menuPHP[] = $elementPHP;
        }
        
        if ($checkActive == 1) {
            return [ $menuPHP, $active ];    
        } else {
            return $menuPHP;
        }
        
    }
    
/*

    ███████╗██████╗  ██████╗ ███╗   ██╗████████╗
    ██╔════╝██╔══██╗██╔═══██╗████╗  ██║╚══██╔══╝
    █████╗  ██████╔╝██║   ██║██╔██╗ ██║   ██║   
    ██╔══╝  ██╔══██╗██║   ██║██║╚██╗██║   ██║   
    ██║     ██║  ██║╚██████╔╝██║ ╚████║   ██║   
    ╚═╝     ╚═╝  ╚═╝ ╚═════╝ ╚═╝  ╚═══╝   ╚═╝   

*/
    private static function renderFrontendPage( ) {
        $page = self::$pagekey;
        
        $pagedata = self::$db['page'][$page];
        
        $templatelocation = 'themes/'.self::$theme.'/template/'.$pagedata['template']. '.php';        
        $cachelocation= 'cache/'.$pagedata['url']. '.php';  
        
        if (self::$login == true) {
            $cachelocationPHP = 'cache/login.php';  
            $template = file_get_contents( $templatelocation );
            $templateWithContent = self::replaceTagsWithContent($template, $pagedata);
            $templateWithContent = self::loginPanel($templateWithContent);
            file_put_contents( $cachelocation , $templateWithContent ); 
            require_once( $cachelocation ); 
            
            return;
        }
        
        
        if ( file_exists( $cachelocation ) && $pagedata['cache'] == 1 && isset($pagedata['cached']) ) {
            $update_time = new DateTime($pagedata['updated']);
            $cache_time = new DateTime($pagedata['cached']);
            
            //Nothing change
            if ($update_time < $cache_time) {
                $cachedtemplate = file_get_contents( $cachelocation );
                require_once( $cachelocation ); 
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
                self::$db['page'][self::$pagekey]['cached'] = date("Y-m-d H:i:s");
                self::saveDataToJSON();   
            }
            require_once( $cachelocation ); 
//            echo '<hr>';
//            echo 'RENDER';
            return;
        }
    }	
    
    private static function putContentInBlocks( $matches ) {
        
        if ( isset( self::$db['page'][self::$pagekey]['block'][$matches[1]] ) ) {
            /* There is data for this block */
            $dataToPutInBlock = self::$db['page'][self::$pagekey]['block'][$matches[1]];
            
            
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
    
    private static function removeSpaces( $matches ) {
        return preg_replace('/\s+/', ' ', $matches[2]);
    }
    
    private static function loginPanel( $templateWithContent ) {
        
        $login_template = file_get_contents( 'admin/template/login.php' );
         
        $templateWithContent = str_replace("</body>", $login_template."</body>", $templateWithContent);
        
        return $templateWithContent;
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
        $page = self::$pagekey;
        
        $pagedata = self::$db['page'][$page];
        
        $templatelocation = 'themes/'.self::$theme.'/template/'.$pagedata['template']. '.php';
        $admincachelocation = 'admincache/'.$pagedata['url']. '.php';
        
        if ( file_exists( $templatelocation ) ) {
            $template = file_get_contents( $templatelocation );
            $templateWithContent = self::replaceTagsWithContent($template, $pagedata);
            
            $templateWithContent = self::adminPanel($templateWithContent);
                
            file_put_contents( $admincachelocation , $templateWithContent );          
            

            require_once( $admincachelocation );
            return;
        }
    }
    
    private static function generateInputsWithContent( $matches ) {  
        $blockcode = $matches[0];
        if (strpos($blockcode, '(block') !== false) {
            
            if ( isset( self::$db['page'][self::$pagekey]['block'][$matches[1]] ) ) {
                $content = self::$db['page'][self::$pagekey]['block'][$matches[1]];
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
        
        $subpage_template = file_get_contents( 'admin/template/admin.php' );
         
        $templateWithContent = str_replace("</body>", $subpage_template."</body>", $templateWithContent);
        
        return $templateWithContent;
    }
    
    private static function getAvailablePages() {        
        $pages = self::$db['page'];
        $pagesArray = [];
        foreach($pages as $index => $page) {
            $pagesArray[$index] = $page['menu_name'];
        } 
        return $pagesArray;
    }
    
    private static function getAvailableTemplates() {
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
    
    private static function adminAjaxAction($action) {
        switch ($action) {
            case 'logout':
                unset($_SESSION['pah']);
                $responseJSON['status'] = 'success';
                $responseJSON['text'] = 'Wylogowano. Odświeżanie... <i class="primal-icon-refresh"></i>';
                $responseJSON['reload'] = true;

                echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);

                break;
            case 'page_update':
                // Saving blocks                
                if ( isset($_POST['blockkeys']) ) {
                    $blocks = explode(",", $_POST['blockkeys']);
                    foreach($blocks as $block) {
                        self::$db['page'][self::$pagekey]['block'][$block] = self::makeThisSafeHTML($_POST[$block]);
                    }
                }
                if ( isset($_POST['siteblockkeys']) ) {
                    $siteblocks = explode(",", $_POST['siteblockkeys']);
                    foreach($siteblocks as $siteblock) {
                        self::$db['siteblock'][$siteblock] = self::makeThisSafeHTML($_POST[$siteblock]);
                    }
                }

                self::$db['page'][self::$pagekey]['title'] = (isset($_POST['title'])) ? self::makeThisSafe($_POST['title']) : self::$db['page'][self::$pagekey]['title'];

                self::$db['page'][self::$pagekey]['active'] = (isset($_POST['active'])) ? 1 : 0;
                self::$db['page'][self::$pagekey]['seoindex'] = (isset($_POST['seoindex'])) ? 1 : 0;
                self::$db['page'][self::$pagekey]['cache'] = (isset($_POST['cache'])) ? 1 : 0; 

                self::$db['page'][self::$pagekey]['template'] = (isset($_POST['template'])) ? $_POST['template'] : self::$db['page'][self::$pagekey]['template'];

                self::$db['page'][self::$pagekey]['metadescription'] = (isset($_POST['metadescription'])) ? self::makeThisSafe( $_POST['metadescription'] ) : '';
                self::$db['page'][self::$pagekey]['menu_name'] = (isset($_POST['menu_name'])) ? self::makeThisSafe( $_POST['menu_name'] ) : self::$db['page'][self::$pagekey]['menu_name'];

                self::$db['page'][self::$pagekey]['updated'] = date("Y-m-d H:i:s");
                
                
                $responseJSON = [];
                
                $postedURL = self::makeThisSafe( $_POST['url'] );
                if ( $postedURL != self::$db['page'][self::$pagekey]['url']) {
                    self::$db['page'][self::$pagekey]['url'] = self::makeThisSafeURL( $postedURL );
                    $responseJSON['newurl'] = self::$cmscatalog.self::makeThisSafeURL( $postedURL );
                    $responseJSON['reload'] = true;
                }
                $responseJSON['status'] = 'success';
                $responseJSON['text'] = 'Strona została zaktualizowana. <i class="primal-icon-download"></i>';
                self::saveDataToJSON(); 
                
                echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);
                break;
                
            case 'site_update':
                
                self::$db['sitename'] = (isset($_POST['sitename'])) ? self::makeThisSafe($_POST['sitename']) : self::$db['sitename'];
                self::$db['homepage'] = (isset($_POST['homepage'])) ? self::makeThisSafe($_POST['homepage']) : self::$db['homepage'];                
                
                if ( isset($_POST['menukeys']) ) {
                    $menukeys = str_replace('&qout;','"',$_POST['menukeys']);
                    $menukeys = self::makeThisSafe( $menukeys );
                    self::$db['menu'] = json_decode( $menukeys , true );
                }
                
                $responseJSON = [];
                $responseJSON['reload'] = true;
                $responseJSON['status'] = 'success';
                $responseJSON['text'] = 'Portal został zaktualizowany. <i class="primal-icon-download"></i>';
                self::saveDataToJSON(); 
                
                echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);
                break;
        }
    }
    
}
    
primal::init();
?>