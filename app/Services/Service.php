<?php 






namespace App\Services;



use Storage;



abstract class Service
{

	public function uploadPhoto($request)
	{
		return $request->file('photo')->store('tweets','public');
	}


	public function updatePhoto($request,$old)
	{
		if ( $this->checkOldPhoto($old) )
		{
			$this->deleteFile($old)
		}

		return $this->uploadPhoto($request);
	}

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


	protected function checkOldPhoto($path)
	{
		return !is_null($path)
	}
}