
	elRTE.prototype.options.panels.adminPanel1 = [ 'bold', 'italic', 'underline', 'forecolor', 'justifyleft', 'justifyright', 'justifycenter', 'justifyfull', 'formatblock', 'insertorderedlist', 'insertunorderedlist', 'table'];
    elRTE.prototype.options.panels.adminPanel2 = [ 'undo', 'redo','superscript', 'subscript','strikethrough', 'nbsp', 'link', 'image', 'flash'];
	elRTE.prototype.options.toolbars.adminToolbar = ['adminPanel1', 'adminPanel2'];
 var opts = {
                    cssClass : 'el-rte',
                    width	 : 465,
                    allowSource	: true,
                    height   : 350,
                    toolbar  : 'adminToolbar',
                    cssfiles : ['css/elrte-inner.css'],
					fmOpen : function(callback) {
						$('<div />').dialogelfinder({
						  url: '<?php echo base_url("ex_cont/elfinder_init"); ?>',
						  commandsOptions: {
							getfile: {
							  oncomplete: 'destroy' // destroy elFinder after file selection
							}
						  },
						  getFileCallback: callback // pass callback to file manager
						});
					  }					
                }
                $('#editor').elrte(opts);
				