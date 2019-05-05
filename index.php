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
    private static $db = array();
    private static $debug = false;
    private static $theme = 'safari';
    private static $dir_cms = '/';
    private static $admin_lang = 'pl';
    private static $admin = false;
    private static $login = false;
    private static $admin_user_name = '';   
    private static $lang = array();
    private static $adminSessionHash = 'adminHash';
    private static $minifyHTML = true;
    public static $pageToRender = '';
    
    
    private function setPrimalConfig() {
        /* You can adjust your CMS settings in config.php file */
        require_once( 'config.php' ); 
        if ( !empty($config['basedir']) ) { self::$dir_cms = $config['basedir']; } 
        if ( !empty($config['admin_lang']) ) { self::$admin_lang = $config['admin_lang']; } 
        if ( !empty($config['debug']) ) { self::$debug = $config['debug']; }
        if ( !empty($config['theme']) ) { self::$theme = $config['theme']; }
        require_once(__DIR__.'/admin/langs/'.self::$admin_lang.'.php');
        self::$lang = $lang;
    }
    
	public static function init() {
        self::isAdminLogedIn();                
        self::setPrimalConfig();
        self::$db = self::getDataFromJSON();
        self::$pageToRender = self::getPageKeyFromUrl();
        
        if ( self::$admin == true ) {
            if ( isset($_GET['action']) ) {
                $action = self::makeThisSafe( $_GET['action'] );
                self::adminAjaxAction( $action );
            } else {
                self::renderBackendPage( );   
                self::renderDebug( );
            }
		} else {
            self::renderFrontendPage( );
        } 
    }
    
    private function getPageKeyFromUrl() {
        $chosenPageAlias = self::$db['homepage'];
        /* if subpage was requsted */
        if ( $page = isset( $_GET['page'] ) ) {
            $pages = self::$db['page'];
            $requestedURL = self::makeThisSafe( $_GET['page'] );

            /* login action */
            if ( $requestedURL == 'login' ) {
                $chosenPageAlias = self::$db['homepage'];
                if ( self::$admin == false ) {
                    self::$login = true;
                    self::loginAjaxAction();
                }
            } else {
                /* assuming 404 error */
                $chosenPageAlias = '404';

                /* searching for url in pages */
                foreach($pages as $index => $page) {
                    if ($page['url'] == $requestedURL) {
                        if ( $page['active']==1 || self::$admin == true ) {
                            $chosenPageAlias = $index;   
                        }
                        break;
                    }
                } 
            }
        }
        return $chosenPageAlias;
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
        
        $pagedata = self::$db['page'][self::$pageToRender];  
        $page = $pagedata['url'];    
        
        $allowedNames = '[a-zA-Z]{1}[a-zA-Z0-9]+'; 
            
        /* Replacing subtemplates */
        $subtemplates = '/\(subtemplate[^\)]+name=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (subtemplate key='')
        $i = 0;
        do {
            $templateString = preg_replace_callback($subtemplates, 'self::replaceWithSubtemplate', $templateString);
            $i++;
        } while ( preg_match($subtemplates, $templateString) && $i < 10 );
            
        
        /* 
            This variables are available in PHP template by default.
                'variable_name' => $variable_value,
        */
        $variablesInTemplate = array(
            'dir_cms' => self::$dir_cms,
            'dir_theme' => self::$dir_cms.'themes/'.self::$theme.'/',
            'site_name' => self::$db['site_name'],
            'page_active' => $pagedata['active'],
            'page_cache' => $pagedata['cache'],
            'page_menu_name' => $pagedata['menu_name'],
            'page_template' => $pagedata['template'],
            'page_url' => $pagedata['url'],
            'page_title' => $pagedata['title'],
            'page_seo_index' => $pagedata['seo_index'],
            'page_meta_description' => $pagedata['metadescription'],
        );
        /*
            You can call them in your template file like this:
                - <?php echo $variable_name; ?>
                - ((variable_name))
        */
        $phpVars = '<?php ';
        foreach($variablesInTemplate as $var_name => $var_value) {
            $phpVars .= ' $'.$var_name.'="'.$var_value.'"; ';
            $templateString = str_replace('(('.$var_name.'))', $var_value, $templateString);
        }
        
        $phpVars .= ' $siteblocks=\''.json_encode( self::$db['siteblock'] , JSON_UNESCAPED_UNICODE).'\'; $siteblock=json_decode( $siteblocks , true ); ';
        $phpVars .= ' $blocks=\''.json_encode( $pagedata['block'] , JSON_UNESCAPED_UNICODE).'\'; $block=json_decode( $blocks , true ); ';        
        $menus = self::$db['menu'];
        
        $menuPHP = [];
        
        foreach($menus as $menuKey => $menu) {
            $menuPHP[$menuKey] = self::renderMenu( $menu );
        }
        
        $phpVars .= ' $menus=\''.json_encode( $menuPHP , JSON_UNESCAPED_UNICODE).'\'; $menu=json_decode( $menus , true ); ';       
        
        
        if (self::$admin == true) {
            /* Page blocks */
            $blocks = '/\(block[^\)]+key=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (block key='')
            $templateString = preg_replace_callback($blocks, 'self::generateInputsWithContent', $templateString);
        
            /* Global blocks */
            $siteblocks = '/\(siteblock[^\)]+key=\'('.$allowedNames.')\'[^\)]*\)/'; // return key for (siteblock key='')
            $templateString = preg_replace_callback($siteblocks, 'self::generateInputsWithContent', $templateString);
            
            /* Admin vars */
            $adminVariablesInTemplate = array(
                'admin' => true,
                'admin_lang' => self::$admin_lang,
                'admin_user_name' => self::$admin_user_name,
            );
            foreach($adminVariablesInTemplate as $var_name => $var_value) {
                $phpVars .= ' $'.$var_name.'="'.$var_value.'"; ';
            }
            
            
            $phpVars .= ' $admin=true; ';
            $phpVars .= ' $admin_lang="'.self::$admin_lang.'"; ';
            $phpVars .= ' $admin_user_name="'.self::$admin_user_name.'"; ';
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
                    $elementPHP['url'] = self::$dir_cms;
                } else if ( isset( self::$db['page'][ $element['key'] ]['url'] ) ) {
                    $elementPHP['url'] =  self::$dir_cms.self::$db['page'][ $element['key'] ]['url'];
                } else {
                    $elementPHP['url'] = self::$dir_cms.'404';
                }
                
                if ( $element['key'] == self::$pageToRender ) {
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
        $page = self::$pageToRender;
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
                self::$db['page'][self::$pageToRender]['cached'] = date("Y-m-d H:i:s");
                self::saveDataToJSON();   
            }
            require_once( $cachelocation ); 
//            echo '<hr>';
//            echo 'RENDER';
            return;
        }
    }	
    
    private static function putContentInBlocks( $matches ) {
        
        if ( isset( self::$db['page'][self::$pageToRender]['block'][$matches[1]] ) ) {
            /* There is data for this block */
            $dataToPutInBlock = self::$db['page'][self::$pageToRender]['block'][$matches[1]];
            
            
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
    private static function isAdminLogedIn( ) {
        if ( isset($_SESSION['pah']) && $_SESSION['pah'] == self::$adminSessionHash ) {
            self::$admin = true;
            self::$admin_user_name = $_SESSION['user'];
            return true;
        }
        return false;
    }
    
    private static function renderDebug( ) {
        if ( self::$debug == true ) {
            echo '<hr> <h1>CONTENT of JSON DATABASE - last update - '.self::$db['updated'].' </h1>';
            echo '<pre>';
            print_r(self::$db);
            echo '</pre>';
        }
    }
    
    private static function renderBackendPage( ) {
        $page = self::$pageToRender;
        
        $pagedata = self::$db['page'][$page];
        
        $templatelocation = 'themes/'.self::$theme.'/template/'.$pagedata['template']. '.php';
        $admincachelocation = 'cache/admin_primal_'.$pagedata['url']. '.php';
        
        if ( file_exists( $templatelocation ) ) {
            $template = file_get_contents( $templatelocation );
            $templateWithContent = self::replaceTagsWithContent($template, $pagedata);
            
            $templateWithContent = self::adminPanel($templateWithContent);
                
            file_put_contents( $admincachelocation , $templateWithContent );          
            

            require_once( $admincachelocation );
            unlink( $admincachelocation );
            return;
        }
    }
    
    private static function generateInputsWithContent( $matches ) {  
        $blockcode = $matches[0];
        if (strpos($blockcode, '(block') !== false) {
            
            if ( isset( self::$db['page'][self::$pageToRender]['block'][$matches[1]] ) ) {
                $content = self::$db['page'][self::$pageToRender]['block'][$matches[1]];
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
    
   private static function translate($key) {
        if ( isset( self::$lang[$key] ) ) {
            return self::$lang[$key];
        } else {
            return $key;
        }
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
    
    private static function clearCache() {
        $filesInDir = scandir('cache/');
        $removedCachedFile = false;
        
        foreach($filesInDir as $file) {
            if (preg_match('/(.php|.html)$/', $file)) {
                unlink( 'cache/'.$file );
                $removedCachedFile = true;
            }
        }
        return $removedCachedFile;
    }
    
    private static function adminAjaxResponse( $status = 'fail', $text = '', $reload = false, $newurl = '') {
        $responseJSON = array();
        $responseJSON['status'] = $status;
        $responseJSON['text'] = $text;
        $responseJSON['reload'] = $reload;
        if ( !empty($newurl) ) { $responseJSON['newurl'] = $newurl;}

        echo json_encode( $responseJSON , JSON_UNESCAPED_UNICODE);
    }
    
    private function loginAjaxAction() {
        if ( isset($_GET['action']) && $_GET['action'] == 'login' ) {
            $postuser = self::makeThisSafe( $_POST['user'] );
            $postpassword = self::makeThisSafe( $_POST['password'] );

            if ( file_exists( 'admin/users/'.$postuser.'.php' ) ) {
                require_once( 'admin/users/'.$postuser.'.php' );

                if ( $postpassword == $user_password_hash ) {
                    $_SESSION['pah'] = self::$adminSessionHash;
                    $_SESSION['user'] = $postuser;
                    self::adminAjaxResponse('success', self::translate('you_login').' <i class="primal-icon-refresh"></i>', true);    

                } else {                  
                    self::adminAjaxResponse('error', self::translate('login_error').' <i class="primal-icon-cancel"></i>');    
                }
            } else {
                self::adminAjaxResponse('error', self::translate('login_error').' <i class="primal-icon-cancel"></i>');    
            }                  
            die();
        }
    }
    
    private static function adminAjaxAction($action) {
        switch ($action) {
            case 'logout':
                unset($_SESSION['pah']);
                unset($_SESSION['user']);   
                self::adminAjaxResponse('success', self::translate('you_logout').' <i class="primal-icon-refresh"></i>', true);    

                break;
            case 'page_update':
                // Saving blocks                
                if ( isset($_POST['blockkeys']) ) {
                    $blocks = explode(",", $_POST['blockkeys']);
                    foreach($blocks as $block) {
                        self::$db['page'][self::$pageToRender]['block'][$block] = self::makeThisSafeHTML($_POST[$block]);
                    }
                }
                if ( isset($_POST['siteblockkeys']) ) {
                    $siteblocks = explode(",", $_POST['siteblockkeys']);
                    foreach($siteblocks as $siteblock) {
                        self::$db['siteblock'][$siteblock] = self::makeThisSafeHTML($_POST[$siteblock]);
                    }
                }

                self::$db['page'][self::$pageToRender]['title'] = (isset($_POST['title'])) ? self::makeThisSafe($_POST['title']) : self::$db['page'][self::$pageToRender]['title'];

                self::$db['page'][self::$pageToRender]['active'] = (isset($_POST['active'])) ? 1 : 0;
                self::$db['page'][self::$pageToRender]['seo_index'] = (isset($_POST['seo_index'])) ? 1 : 0;
                self::$db['page'][self::$pageToRender]['cache'] = (isset($_POST['cache'])) ? 1 : 0; 

                self::$db['page'][self::$pageToRender]['template'] = (isset($_POST['template'])) ? $_POST['template'] : self::$db['page'][self::$pageToRender]['template'];

                self::$db['page'][self::$pageToRender]['metadescription'] = (isset($_POST['metadescription'])) ? self::makeThisSafe( $_POST['metadescription'] ) : '';
                self::$db['page'][self::$pageToRender]['menu_name'] = (isset($_POST['menu_name'])) ? self::makeThisSafe( $_POST['menu_name'] ) : self::$db['page'][self::$pageToRender]['menu_name'];

                self::$db['page'][self::$pageToRender]['updated'] = date("Y-m-d H:i:s");
                
                $postedURL = self::makeThisSafe( $_POST['url'] );
                $newurl = '';
                if ( $postedURL != self::$db['page'][self::$pageToRender]['url']) {
                    self::$db['page'][self::$pageToRender]['url'] = self::makeThisSafeURL( $postedURL );
                    $newurl = self::$dir_cms.self::makeThisSafeURL( $postedURL );
                }
                
                self::saveDataToJSON(); 
                
                if ( empty($newurl) ) {
                    self::adminAjaxResponse('success', self::translate('subpage_was_updated').' <i class="primal-icon-download"></i>');    
                } else {
                    self::adminAjaxResponse('success',  self::translate('subpage_was_updated').' <i class="primal-icon-download"></i>', true, $newurl);    
                }
                
                
                break;
                
            case 'site_update':
                
                self::$db['site_name'] = (isset($_POST['site_name'])) ? self::makeThisSafe($_POST['site_name']) : self::$db['site_name'];
                self::$db['homepage'] = (isset($_POST['homepage'])) ? self::makeThisSafe($_POST['homepage']) : self::$db['homepage'];                
                
                if ( isset($_POST['menukeys']) ) {
                    $menukeys = str_replace('&qout;','"',$_POST['menukeys']);
                    $menukeys = self::makeThisSafe( $menukeys );
                    self::$db['menu'] = json_decode( $menukeys , true );
                }
                
                
                self::saveDataToJSON(); 
                self::adminAjaxResponse('success', self::translate('site_was_updated').' <i class="primal-icon-download"></i>', true);
                
                break;
                
            case 'clear_cache':
                
                if ( self::clearCache() == true ) {
                    self::adminAjaxResponse('success', self::translate('cache_was_cleared').' <i class="primal-icon-trash"></i>');
                } else {
                    self::adminAjaxResponse('success', self::translate('cache_is_empty').' <i class="primal-icon-clock"></i>');
                } 
                break;
                
            default:
                self::adminAjaxResponse('fail', self::translate('unknown_action').' "'.$action.'". <i class="primal-icon-cog"></i>');
        }
        die();
    }
}
    
primal::init();
?>