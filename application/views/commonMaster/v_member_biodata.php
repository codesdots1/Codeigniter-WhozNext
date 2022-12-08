<?php
//printArray($imageList,1);
$html = '';
//$type = 'stay';
foreach ($bioData as $key => $memberBioData){
    $bioDataUrl = $this->config->item('member_biodata_path').$memberBioData['filename'];

    $ext = pathinfo($memberBioData['filename'], PATHINFO_EXTENSION);

    if($ext == 'pdf'){
        $bioData =  '<img src="'.base_url().$this->config->item('biodata_pdf').'" alt="">';
    }elseif ($ext == 'docx'){
        $bioData =  '<img src="'.base_url().$this->config->item('biodata_docx').'" alt="" style="height:140px; width:140px;">';
    } else{
        $bioData = '<img src="'.base_url().$this->config->item('member_biodata_path').$memberBioData['filename'].'" alt="" style="height:140px; width:140px;">';
    }
    $html .= '<div class="col-md-4">' .
        '<div class="thumbnail" >' .
        '<div class="thumb">';
    $html .= $bioData;
    $html .= '<div class="caption-overflow">' .
        '<span>' .
        '<a title="View" href="'.base_url().$this->config->item('member_biodata_path').$memberBioData['filename'].'" data-popup="lightbox" rel="member" class="btn btn-sm border-white text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-eye"></i></a>'.
        '<a download title="Download" href="'.base_url().$this->config->item('member_biodata_path').$memberBioData['filename'].'" class="btn border-white btn-sm text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-download4"></i></a>'.
        '<a title="Delete" class="btn border-white text-white btn-sm btn-flat btn-icon btn-rounded legitRipple" onclick="deleteBioData('.$memberBioData['member_biodata_file_id'].',\''.$bioDataUrl.'\')"><i class="icon-trash"></i></a>'.
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