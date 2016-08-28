<?php namespace App\Helper\Src;

class Helper
{
	public function __construct()
	{
		$this->backendUrl = config('path.backendUrl');
		$this->backendName = config('path.backendName');
	}
	
	public function hello()
	{
		return 'DEMO';
	}

	public function config($config)
	{
		return config('path.'.$config);
	}

	public function buttonUpdate($params)
	{
		if($this->right('update') == 'true')
		{
			$url = urlBackendAction('update/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span></a>';	
		}
	}
	
	public function buttonUpdateCustom($params, $method="update")
	{
		if($this->right('update') == 'true')
		{
			$url = urlBackendAction($method.'/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span></a>';	
		}
	}

	public function buttonDelete($params)
	{	
		if($this->right('delete') == 'true')
		{
			$url = urlBackendAction('delete/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-danger btn-sm" onclick = "return confirm(\'Are You sure want to delete this data?\')"><span class="glyphicon glyphicon-trash"></span></a>';	
		}
	}
	
	public function buttonDeleteCustom($params, $method="delete")
	{	
		if($this->right('delete') == 'true')
		{
			$url = urlBackendAction($method.'/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-danger btn-sm" onclick = "return confirm(\'Are You sure want to delete this data?\')"><span class="glyphicon glyphicon-trash"></span></a>';	
		}
	}
	
	public function buttonView($params)
	{
		if($this->right('view') == 'true')
		{
			$url = urlBackendAction('view/'.$params);
			
			return '<a href = "'.$url.'" class = "btn btn-warning btn-sm"><span class="glyphicon glyphicon-search"></span></a>';	
		}
	}

	public function buttonCreate($params="")
	{
		if($this->right('create') == 'true')
		{
			$url = urlBackendAction('create/'.$params);
			return '<a href = "'.$url.'" class = "btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Add New</a>';
		}
	}
	
	public function buttonCreateCustom($params="", $method='create', $label="Add New")
	{
		if($this->right('create') == 'true')
		{
			$url = urlBackendAction($method.'/'.$params);
			return '<a href = "'.$url.'" class = "btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> '.$label.'</a>';
		}
	}
	
	public function buttonPublish($params,$status = true)
	{
		if($this->right('publish') == 'true')
		{
			$url = urlBackendAction('publish/'.$params);
			$active =  '<a onclick = "return confirm(\'are you sure want to un publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><span class="glyphicon glyphicon-eye-open"></span></a>';
			$notActive =  '<a onclick = "return confirm(\'are you sure want to  publish this data ?\')" href = "'.$url.'" class = "btn btn-default btn-sm"><span class="glyphicon glyphicon-eye-close"></span></a>';
			
			if($status == true)
			{
				return $active;
			}else{
				return $notActive;
			}
		}
	}

	public function buttons($id , $array = [] , $status = false, $custom=false)
	{
		($array == []) ? $array = ['update','view','delete','publish'] : $array = $array;

		$str = "";

		foreach($array as $button)
		{
			if($button == 'update')
			{
				if (is_array($custom)) {
					$str .= $this->buttonUpdateCustom($id, $custom['methodupdate']).' ';
				} else $str .= $this->buttonUpdate($id).' ';
			
			}elseif($button == 'view'){
				
				$str .= $this->buttonView($id).' ';
			
			}elseif($button == 'delete'){
				if (is_array($custom)) {
					$str .= $this->buttonDeleteCustom($id, $custom['methoddelete']).' ';
				} else $str .= $this->buttonDelete($id).' ';
			}elseif($button == 'publish'){
				

				$str .= $this->buttonPublish($id,$status).' ';
			
			}
		}

		return $str;
	}

	public function getMenu()
	{
		$permalink = request()->segment(2);

		$model = injectModel('Menu')->whereSlug($permalink)->first();
		
		return $model;
	}

	public function getAction($slug = "")
	{
		if(!empty($slug))
		{
			$slug = $slug;
		}else{
			$slug = request()->segment(3);
		}

		$model = injectModel('Action')->whereSlug($slug)->first();

		if(!empty($model->id))
		{
			return $model;
		}else{
			return injectModel('Action');
		}
			
	}

	public function titleActionForm()
	{	
		$actions = $this->getAction();

		$title =  $actions->title.' '.$this->getMenu()->title;

		return $title;
	}

	public function right($action = "")
	{

		if(!empty($action))
		{
			$action = $action;
		}else{
			$action = request()->segment(3);
		}

		$menu = $this->getMenu();

		if($menu->slug == 'dashboard')
		{
			return 'true';
		}else{
			$modelAction = $this->getAction($action);

			if(!empty($modelAction->id))
			{
				$role = injectModel('Role')->find(getUser()->role_id);

				$right = $role->menu_actions()->whereMenuId($menu->id)->whereActionId($modelAction->id)->first();

				if(!empty($right->id))
				{
					return 'true';
				}else{
					return 'false';
				}
			}else{
				return 'true';
			}
				
		}
		
	}

	public function addMenu($data = [],$actions=[])
	{	
		\DB::beginTransaction();
		try
		{
			$model = injectModel('Menu');
			
			$cek = $model->whereSlug($data['slug'])->first();

			if($data['parent_id'] != null)
			{
				$parent = $model->whereSlug($data['parent_id'])->first();
				$data['parent_id'] = $parent->id;
			}

			if(empty($cek->id))
			{
				$save = $model->create($data);

				$action = injectModel('Action');
				
				$menuAction = injectModel('MenuAction');

				$right = injectModel('Right');

				foreach($actions as $row)
				{
					$cekAction = $action->whereSlug($row)->first();

					if(!empty($cekAction->id))
					{
						$menuActionSave = $menuAction->create([
							'menu_id'		=> $save->id,
							'action_id'		=> $cekAction->id,
						]);

						$right->create([
							'role_id'			=> 1,
							'menu_action_id'	=> $menuActionSave->id,
						]);
					}
				}

			}

			\DB::commit();
		
		}catch(\Exception $e){
			\DB::rollback();
			echo "menu gagal disimpan : ".$e->getMessage();
		}

	}

	public function updateMenu($data = [],$actions=[])
	{
		$model = injectModel('Menu');
		
		if($data['parent_id'] != null)
		{
			$parent = $model->whereSlug($data['parent_id'])->first();
			$data['parent_id'] = $parent->id;
		}

		//$parent = $model->whereSlug($data['parent_id'])->first();
		
		$update = $model->whereSlug($data['slug'])->first();

		//$data['parent_id'] = $parent->id;

		$update->update($data);

		$action = injectModel('Action');
			
		$menuAction = injectModel('MenuAction');

		$right = injectModel('Right');

		\DB::table('menu_actions')->where('menu_id',$update->id)->delete();

		foreach($actions as $row)
		{
			$cekAction = $action->whereSlug($row)->first();

			if(!empty($cekAction->id))
			{
				$menuActionSave = $menuAction->create([
					'menu_id'		=> $update->id,
					'action_id'		=> $cekAction->id,
				]);
				
				$right->create([
					'role_id'			=> 1,
					'menu_action_id'	=> $menuActionSave->id,
				]);
			}
		}

	}

	public function deleteMenu($slug)
	{
		$model = injectModel('Menu')->whereSlug($slug)->first()->delete();
	}
	
	public function dateToDb($date)
	{
		$date = date("Y-m-d" , strtotime($date));
		return $date;
	}

	public function dbToDate($date)
	{
		$date = date("d-m-Y" , strtotime($date));
		return $date;
	}
	
	public function globalUpload($request, $tmpname=false, $customPath=false, $sourceServer=false)
	{
		
		if ($customPath) $folderPath = public_path('contents'). '/'.$customPath."/" ;
		else $folderPath = public_path('contents/file'). "/" ;
		
		if (!\File::isDirectory($folderPath)) \File::makeDirectory($folderPath, 0775, true);
		
		if ($sourceServer) {
			$tmpPath =  public_path() . str_replace("%20", " ", $request->image);
			$ext = pathinfo($tmpPath, PATHINFO_EXTENSION);
			$filename = ($tmpname) ? $tmpname . '.' .$ext : 'ori-'.rand() . ".".$ext ;
			\File::copy($tmpPath, $folderPath . "/" . 'ori-'.rand());
		} else {
			$file = $request->file($tmpname);
			$filename = rand(1,1000) . '-'. str_replace(' ', '_', $file->getClientOriginalName());
			$saveFile = $request->file($tmpname)->move($folderPath, $filename);
		}
		
		return array('filename'=>$filename);
		
	}
	
	public function handleUpload($request, $filename=false, $customPath=false, $saveOri=false, $random = false)
    {
		
		if ($customPath) $folderPath = public_path('contents'). '/'.$customPath."/" ;
		else $folderPath = public_path('contents/news'). "/" ;
		
		if (!\File::isDirectory($folderPath)) $createfolderPath = \File::makeDirectory($folderPath, 0775, true);

		$largePath = $folderPath . 'large';
		$mediumPath = $folderPath . 'medium';
        $smallPath = $folderPath . 'small';
        $thumbPath = $folderPath . 'thumbnail';
		
		if (!\File::isDirectory($largePath)) \File::makeDirectory($largePath, 0775, true);
		if (!\File::isDirectory($mediumPath)) \File::makeDirectory($mediumPath, 0775, true);
        if (!\File::isDirectory($smallPath)) \File::makeDirectory($smallPath, 0775, true);
        if (!\File::isDirectory($thumbPath)) \File::makeDirectory($thumbPath, 0775, true);
		
		$tmpPath =  public_path() . str_replace("%20", " ", $request->image);
		
		$ext = pathinfo($tmpPath, PATHINFO_EXTENSION);
		
		if ($saveOri) {
			\File::copy($tmpPath, $largePath . "/" . 'ori-'.$filename .".".$ext);
		}
		
		$resizeImageLarge = $this->resizeImage($tmpPath, 700);
		$resizeImageMedium = $this->resizeImage($tmpPath, 400);
		$resizeImageThumb = $this->resizeImage($tmpPath, 250);
		$resizeImageSmall = $this->resizeImage($tmpPath, 100);
				
		// image large
		$newPathLarge = $largePath . "/" . $filename .".".$ext;
		$img['large'] = \Image::make($tmpPath)->resize($resizeImageLarge['width'], $resizeImageLarge['height'])->save($newPathLarge);
		
		// image small 1
		$newPathMedium = $mediumPath . "/" . $filename .".".$ext;
		$img['medium'] = \Image::make($tmpPath)->resize($resizeImageMedium['width'], $resizeImageMedium['height'])->save($newPathMedium);

		// image small 2
		$newPathSmall = $smallPath . "/" . $filename .".".$ext;
		$img['small'] = \Image::make($tmpPath)->resize($resizeImageSmall['width'], $resizeImageSmall['height'])->save($newPathSmall);

        // image thumbnail
        $newPathThumb = $thumbPath . "/" . $filename .".".$ext;
		$img['thumbnail'] = \Image::make($tmpPath)->resize($resizeImageThumb['width'], $resizeImageThumb['height'])->save($newPathThumb);

        // \File::delete($tmpPath);

        return ['filename'=>$filename. '.'. $ext];

    }
	
	public function resizeImage($pathImage, $w_resize)
	{
		list($orig_w, $orig_h) = getimagesize($pathImage);
		
		$ratio = $orig_w /$orig_h; // width/height
		if( $ratio > 1) {
			$width = $w_resize;
			$height = $w_resize / $ratio;
		}
		else {
			$width = $w_resize * $ratio;
			$height = $w_resize;
		}
		
		return array('width'=>$width, 'height'=>$height);
	}
	
	public function urlAction($action = "" , $url = "")
	{
		
		$backendName = $this->backendUrl;
		$menu = request()->segment(2);
		
		$generate = $backendName."/".$menu."/".$action;
		
		return ($url == "no") ? $generate : url($generate);
	}
}