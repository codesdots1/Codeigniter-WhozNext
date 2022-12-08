<?php
$html = '';
foreach ($galleryList as $key => $imageData){
	$imageUrl = $this->config->item('staff_gallery').$imageData['galleryname'];

	$ext = pathinfo($imageData['galleryname'], PATHINFO_EXTENSION);

	if($ext == 'pdf'){
		$image=  '<img src="'.base_url().$this->config->item('gallery_pdf').'" alt="" >';
	}else{
		$image = '<img src="'.base_url().$this->config->item('staff_gallery').$imageData['galleryname'].'" alt="" style="height:140px; width:140px;">';
	}
	$html .= '<div class="col-md-4">' .
		'<div class="thumbnail" >' .
		'<div class="thumb">';
	$html .= $image;
	$html .= '<div class="caption-overflow">' .
		'<span>' .
		'<a title="View" href="'.base_url().$this->config->item('staff_gallery').$imageData['galleryname'].'" data-popup="lightbox" rel="member" class="btn btn-sm border-white text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-eye"></i></a>'.
		'<a download title="Download" href="'.base_url().$this->config->item('staff_gallery').$imageData['galleryname'].'" class="btn border-white btn-sm text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-download4"></i></a>'.
		'<a title="Delete" class="btn border-white text-white btn-sm btn-flat btn-icon btn-rounded legitRipple" onclick="deleteGallery('.$imageData['staff_gallery_file_id'].',\''.$imageUrl.'\')"><i class="icon-trash"></i></a>'.
		'</span>' .
		'</div>' .
		'</div>' .
		'</div>' .
		'</div>';
	if(($key+1)%3 == 0){
		$html .= '<div class="clearfix" ></div>';
	}
}
echo $html;
