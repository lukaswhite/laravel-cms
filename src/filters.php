<?php

Route::filter('cms', function()
{
	
});

Route::when('cms/*', 'cms');