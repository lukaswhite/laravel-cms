var Cms = function () {
	
	return { 
    initHome        		:   initHome,
    initAddEditPage     :   initAddEditPage,
    initAddBlock     		:   initAddBlock,
    initEditBlock     	:   initEditBlock,
    initAddRegion     		:   initAddRegion,
    initPlaceBlocks			: 	initPlaceBlocks
  };
	
	function initHome () {
    
		console.log('init home');
	}

	function initAddEditPage () {    
		
		var epic_editor_options = {
		  container: 'page-body-editor',
		  textarea: 'page-body',
		  basePath: '/',
		  clientSideStorage: false,
		  localStorageName: 'epiceditor',
		  useNativeFullscreen: true,
		  parser: marked,
		  file: {
		    name: 'epiceditor',
		    defaultContent: '',
		    autoSave: 100
		  },
		  theme: {
		    base: 'packages/lukaswhite/laravel-cms/js/vendor/epic-editor/themes/base/epiceditor.css',
		    preview: 'packages/lukaswhite/laravel-cms/js/vendor/epic-editor/themes/preview/github.css',
		    editor: 'packages/lukaswhite/laravel-cms/js/vendor/epic-editor/themes/editor/epic-light.css'
		  },
		  button: {
		    preview: true,
		    fullscreen: true,
		    bar: "auto"
		  },
		  focusOnLoad: false,
		  shortcut: {
		    modifier: 18,
		    fullscreen: 70,
		    preview: 80
		  },
		  string: {
		    togglePreview: 'Toggle Preview Mode',
		    toggleEdit: 'Toggle Edit Mode',
		    toggleFullscreen: 'Enter Fullscreen'
		  },
		  autogrow: false
		}
		var editor = new EpicEditor(epic_editor_options);

		$('#page-format').change(function(){
			switch ($(this).val()) {
				case 'markdown':
					$('#page-body').hide();					
					$('#page-body-editor').show();
					break;
				case 'html':				
					//$('#page-body').ckeditor();
					//editor.unload();
					$('#page-body-editor').hide();
					$('#page-body').show();
					break;
			}
		});

		editor.load(function(){
			$('#page-body').hide();
		});

		$('#page-title').slug({ 
      slug:'page-slug', // class of input / span that contains the generated slug 
      hide: false
    });

	}

	function initBlock() {
		var opts = {
		  container: 'block-body-editor',
		  textarea: 'block-body',
		  basePath: '/',
		  clientSideStorage: false,
		  localStorageName: 'epiceditor',
		  useNativeFullscreen: true,
		  parser: marked,
		  file: {
		    name: 'epiceditor',
		    defaultContent: '',
		    autoSave: 100
		  },
		  theme: {
		    base: 'packages/lukaswhite/laravel-cms/js/vendor/epic-editor/themes/base/epiceditor.css',
		    preview: 'packages/lukaswhite/laravel-cms/js/vendor/epic-editor/themes/preview/github.css',
		    editor: 'packages/lukaswhite/laravel-cms/js/vendor/epic-editor/themes/editor/epic-light.css'
		  },
		  button: {
		    preview: true,
		    fullscreen: true,
		    bar: "auto"
		  },
		  focusOnLoad: false,
		  shortcut: {
		    modifier: 18,
		    fullscreen: 70,
		    preview: 80
		  },
		  string: {
		    togglePreview: 'Toggle Preview Mode',
		    toggleEdit: 'Toggle Edit Mode',
		    toggleFullscreen: 'Enter Fullscreen'
		  },
		  autogrow: false
		}
		var editor = new EpicEditor(opts);

		editor.load(function(){
			$('#block-body').hide();
		});
	}

	function initAddBlock () {    
		
		initBlock();

		$('#block-admin-title').slug({ 
      slug:'machine-name', // class of input / span that contains the generated slug 
      hide: false,
      hyphen: "_"
    });

	}

	function initEditBlock () {  

		initBlock();

	}

	function initAddRegion() {    
		
		$('#region-title').slug({ 
      slug:'machine-name', // class of input / span that contains the generated slug 
      hide: false,
      hyphen: "_"
    });

	}

	function initPlaceBlocks() {    
		
		$('#place-blocks-blocks').sortable();

	}

}();