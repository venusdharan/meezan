<?php


function getinfobox($color,$icon,$text,$number,$IsProgressNeeded,$progressValue,$progressText)
{
    
    if($IsProgressNeeded == true)
    {
        $infoboxstart = "<div class='info-box $color'>
    <span class='info-box-icon'><i class='$icon'></i></span>
    <div class='info-box-content'>
    <span class='info-box-text'>$text</span>
    <span class='info-box-number'>$number</span>";
        $progressDiv  = "<div class='progress'>
                        <div class='progress-bar' style='width: $progressValue'></div>
                      </div>";
        $infoboxstop = "<span class='progress-description'>
                            $progressText
                          </span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->";
        return $infoboxstart.$progressDiv.$infoboxstop ; 
    }
    
    if($IsProgressNeeded == false)
    {
        $infoboxstart = "<div class='info-box $color'>
    <span class='info-box-icon'><i class='$icon'></i></span>
    <div class='info-box-content'>
    <span class='info-box-text'>$text</span>
    <span class='info-box-number'>$number</span>";
       
        $infoboxstop = "<span class='progress-description'>
                            $progressText
                          </span>
                        </div><!-- /.info-box-content -->
                      </div><!-- /.info-box -->";
        return $infoboxstart.$infoboxstop ; 
    }
}

?>
