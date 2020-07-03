<?php 





namespace App\Services;


use Storage;



abstract class Service
{
	public function deleteFile($path)
	{
		if ( $this->checkFile($path) )
		{
			Storage::disk('public')->delete($path);
		}

		return false;
	}

	public function checkFile($path)
	{
		return Storage::disk('public')->has($path) ? true : false;
	}
}