<?php
$html = '';
if(!empty($audioList)){
    foreach ($audioList as $key => $audioData) {
        if ($audioData['filename'] != '') {
            $audioUrl = $this->config->item('pachkhan_audio_path') . $audioData['filename'];
            $ext = pathinfo($audioData['filename'], PATHINFO_EXTENSION);
            if ($ext == 'mp3') {
                $image = '<img src="' . site_url() . $this->config->item('audio_mp3') . '" style="height: 50%; width: 50%;">';
            } else {
                $image = '<img src="' . site_url() . $this->config->item('audio_mp3') . $audioData['filename'] . '" style="height: 50%; width: 50%;">';
            }

            $html .= '<div class="col-md-4" >' .
                '<div class="thumbnail" >' .
                '<div class="thumb">';
            $html .= $image;
            $html .= '<div class="caption-overflow">' .
                '<span>' .
                '<a title="Listen" href="' . site_url() . $this->config->item('pachkhan_audio_path') . $audioData['filename'] . '" data-popup="lightbox" rel="gallery" class="btn btn-sm border-white text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-music"></i></a>' .
                '<a download title="Download" href="' . site_url() . $this->config->item('pachkhan_audio_path') . $audioData['filename'] . '" class="btn border-white btn-sm text-white btn-flat btn-icon btn-rounded legitRipple"><i class="icon-download4"></i></a>' .
//                '<a title="Delete" class="btn border-white text-white btn-sm btn-flat btn-icon btn-rounded legitRipple" onclick="deleteAudio(' . $audioData['pachkhan_id'] . ',\'' . $audioUrl . '\')"><i class="icon-trash"></i></a>' .
                '</span>' .
                '</div>' .
                '</div>' .
                '</div>' .
                '</div>';
            if (($key + 1) % 3 == 0) {
                $html .= '<div class="clearfix" ></div>';
            }
        } else {
            continue;
        }
    }
}
echo $html;
?>

