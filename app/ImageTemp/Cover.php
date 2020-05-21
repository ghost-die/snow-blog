<?php


namespace App\ImageTemp;


use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\Image;

class Cover implements FilterInterface
{
	public function applyFilter(Image $image)
	{
		return $image->fit(300, 190);
	}
}