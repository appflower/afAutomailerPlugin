<?php

class Automailer extends BaseAutomailer
{
	public function setContent($module,$partial,$vars)
	{
		$body=get_partial($module.'/'.$partial,$vars);

		if($body)
		{
			parent::setBody($body);
		}

		$alt_body=get_partial($module.'/'.$partial.'.altbody',$vars);

		if($alt_body)
		{
			parent::setAltBody($alt_body);
		}
	}
}
