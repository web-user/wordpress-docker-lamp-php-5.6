<?php

// Simple class to manage icomoon zip files
 
class brad_icon_font{

	var $paths = array();
	var $css_file;
	var $font_prefix;
	var $json_file;
	
	var $font_name = 'empty';

	function __construct()
	{
		$this->paths = wp_upload_dir();
		$this->paths['fonts'] 	= 'brad_fonts';
		$this->paths['temp']  	= trailingslashit($this->paths['fonts']).'brad_temp';
		$this->paths['fontdir'] = trailingslashit($this->paths['basedir']).$this->paths['fonts'];
		$this->paths['tempdir'] = trailingslashit($this->paths['basedir']).$this->paths['temp'];
		$this->paths['fonturl'] = trailingslashit($this->paths['baseurl']).$this->paths['fonts'];
		$this->paths['tempurl'] = trailingslashit($this->paths['baseurl']).trailingslashit($this->paths['temp']);

		
		//font file extract by ajax function
		add_action('wp_ajax_of_ajax_post_redux_file', array($this, 'add_zipped_font'));
		add_action('wp_ajax_of_ajax_delete_redux_file', array($this, 'delete_zipped_font'));

	}
	
	function add_zipped_font()
	{
		//check if referer is ok
		if(function_exists('check_ajax_referer')) {
			if(check_ajax_referer('redux_file_upload_nonce' ,'nonce' , false ) == false ){
				exit("Error : Your page has been expired");
				}
		}
		
		//check if capability is ok
		$cap = apply_filters('brad_file_upload_capability', 'update_plugins');
		if(!current_user_can($cap)) 
		{
			exit( "Error : Using this feature is reserved for Super Admins. You unfortunately don't have the necessary permissions." );
		}

		//get the file path of the zip file
		$attachment = $_POST['attachment'];
		$path 		= realpath(get_attached_file($attachment));
		$unzipped 	= $this->zip_flatten( $path , array('\.eot','\.svg','\.ttf','\.woff','\.css','.json'));
		
		// if we were able to unzip the file and save it to our temp folder extract the svg file
		if($unzipped)
		{
			$this->create_config();
		}
		
		//if we got no name for the font dont add it and delete the temp folder
		if($this->font_name == 'empty')
		{
			$this->delete_folder($this->paths['tempdir']);
			exit('Error : Was not able to retrieve the Font name from your Uploaded Folder');
		}
		
		$response = array('name' => $this->font_name , 'prefix' => $this->font_prefix , 'css_url' => trailingslashit(trailingslashit($this->paths['fonturl']).$this->font_name).$this->css_file , 'css_file' => trailingslashit(trailingslashit($this->paths['fontdir']).$this->font_name).$this->css_file);
		
		// response output
		echo json_encode($response);
		exit;
		
	}
	
	function delete_zipped_font()
	{
		//check if referer is ok
		if(function_exists('check_ajax_referer')) {
			if(check_ajax_referer('redux_file_upload_nonce' ,'nonce' , false ) == false ){
				exit("Error : Your page has been expired");
			}
		}
		
		//check if capability is ok
		$cap = apply_filters('brad_file_upload_capability', 'update_plugins');
		if(!current_user_can($cap)) 
		{
			exit( "Error : Using this feature is reserved for Super Admins. You unfortunately don't have the necessary permissions." );
		}
		
		$font = $_POST['font_name'];
		
		$this->delete_font($font);
		
		// response output
		echo json_encode(array('response' => 'success'));
		exit;
		
	}
	
	function delete_font($font){
		  
		if(empty($font)){ exit('Error : Unable to delete font.');}
		  
		$delete_location = trailingslashit($this->paths['fontdir']).$font;
		$delete_fn_location = trailingslashit($delete_location).'fonts';
		
		$this->delete_folder($delete_fn_location);
		$this->delete_folder($delete_location);
		
		return true;
		
	}
	

	
	function create_folder(&$folder, $addindex = true)
	{
	    if(is_dir($folder) && $addindex == false)
	        return true;

	//      $oldmask = @umask(0);

	    $created = wp_mkdir_p( trailingslashit( $folder ) );
	    @chmod( $folder, 0777 );

	//      $newmask = @umask($oldmask);

	    if($addindex == false) return $created;

	    $index_file = trailingslashit( $folder ) . 'index.php';
	    if ( file_exists( $index_file ) )
	        return $created;

	    $handle = @fopen( $index_file, 'w' );
	    if ($handle)
	    {
	        fwrite( $handle, "<?php\r\necho 'Error : Sorry, browsing the directory is not allowed!';\r\n?>" );
	        fclose( $handle );
	    }

	    return $created;
	}

	//extract the zip file to a flat folder and remove the files that are not needed
	function zip_flatten ( $zipfile , $filter) 
	{ 	
		
		$tempdir = $this->create_folder($this->paths['tempdir'], false);
		if(!$tempdir) exit('Error : Wasn\'t able to create temp folder');
		
	    $zip = new ZipArchive; 
	    
	    if ( $zip->open( $zipfile ) ) 
	    { 
	        for ( $i=0; $i < $zip->numFiles; $i++ ) 
	        { 
	        	
	        	$entry = $zip->getNameIndex($i); 
	        
	        	if(!empty($filter))
				{
	     			$delete 	= true;
	     			$matches 	= array();
	     			
	     			foreach($filter as $regex)
	     			{
	     				preg_match("!".$regex."!", $entry , $matches);
	     				if(!empty($matches))
	     				{
	     					$delete = false;
	     					break;
	     				}
	     			}
				}
	            
	            if ( substr( $entry, -1 ) == '/' || !empty($delete)) continue; // skip directories and non matching files
	            
	            $fp 	= $zip->getStream( $entry ); 
	            $ofp 	= fopen( $this->paths['tempdir'].'/'.basename($entry), 'w' ); 
	            
	            if ( ! $fp ) 
	                exit('Error : Unable to extract the file.'); 
	            
	            while ( ! feof( $fp ) ) 
	                fwrite( $ofp, fread($fp, 8192) ); 
	            
	            fclose($fp); 
	            fclose($ofp); 
	        } 
	
	     $zip->close(); 
	    }
	    else
	    {
	    	exit('Error : Wasn\'t able to work with Zip Archive');
	    }
	    
	    return true; 
	} 
	
	
	
	
	//create the css file
	function create_config()
	{
		$this->json_file = $this->find_json();
		$this->css_file = $this->find_css();
		
		if(empty($this->css_file))
		{
			$this->delete_folder($this->paths['tempdir']);
			exit('Error : Found no style.css file in your zip file.');
		}
		
		if(empty($this->json_file))
		{
			$this->delete_folder($this->paths['tempdir']);
			exit('Error : Found no selection.json file in your zip file.');
		}
		
		
		//$response 	= wp_remote_get( $this->paths['tempurl'].$this->css_file );
		$response   	= wp_remote_fopen(trailingslashit($this->paths['tempurl']).$this->json_file );
		
		//if wordpress wasnt able to get the file which is unlikely try to fetch it old school
		if(empty($response)) $response = file_get_contents(trailingslashit($this->paths['tempdir']).$this->json_file );
		
		if (!is_wp_error($response) && !empty($response))
		{
			    $json_data = json_decode($response, true);
				
				if(empty( $json_data['metadata']['name'])){
					exit('Error : Error in parsing json file');
				}
				$this->font_name = $json_data['metadata']['name'];

				if(empty( $json_data['preferences']['fontPref']['prefix']) || $json_data['preferences']['fontPref']['prefix'] == 'br-' || $json_data['preferences']['fontPref']['prefix'] == 'fa-'){
					exit('Error : Error in finding icon prefix. Do\'t use prefix such as "fa-" or "br-"');
				}
				
				$this->font_prefix = str_replace('-','',$json_data['preferences']['fontPref']['prefix']);
				
				$this->rename_files_folder();

		}
		
		return false;
		
	}
	
	//rename the temp folder and all its font files
	function rename_files_folder()
	{
		$new_name = trailingslashit($this->paths['fontdir']).$this->font_name;
		$new_location = trailingslashit($new_name).'fonts';
		//delete folder and contents if they already exist
		$this->delete_folder($new_location);
		$this->delete_folder($new_name);
		rename($this->paths['tempdir'], $new_name);
		$this->create_folder($new_location,false);
		
		$files = scandir($new_name);
		foreach( $files as $file){
			if( in_array( substr($file, strrpos($file, '.') ) , array('.ttf','.svg','.eot','.woff'))){
				copy(trailingslashit($new_name).$file, trailingslashit($new_location).$file);
			
			}
		}
		
	}
	
	
	//delete a folder
	function delete_folder($new_name)
	{
		//delete folder and contents if they already exist
		if(is_dir($new_name))
		{
			$objects = scandir($new_name);
		     foreach ($objects as $object) {
		       if ($object != "." && $object != "..") {
		         unlink($new_name."/".$object);
		       }
		     }
		     reset($objects);
		     rmdir($new_name);
		}
	}
	
	
	//finds the css file we need to create the config
	function find_css()
	{
		$files = scandir($this->paths['tempdir']);
		
		foreach($files as $file)
		{ 
			if(strtolower($file)  == 'style.css' && $file[0] != '.')
			{
				return $file;
			}
		}
	}
	
	
	//finds the json file we need to create the config
	function find_json()
	{
		$files = scandir($this->paths['tempdir']);
		
		foreach($files as $file)
		{ 
			if(strtolower($file)  == 'selection.json' && $file[0] != '.')
			{
				return $file;
			}
		}
	}


}


$new_icon_font = new brad_icon_font();
