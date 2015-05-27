/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
    config.extraPlugins = "syntaxhighlight";
	CKEDITOR.config.allowedContent = true;
	config.toolbar = 'Index';
	config.toolbar_Index =
	[
        ['Source','Preview','Maximize'],
        ['Cut','Copy','Paste','PasteText'],
        ['SelectAll','RemoveFormat'],
        ['Bold','Italic','Underline','Strike'],
        ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
        ['Link','Unlink','Image','Flash','Table','HorizontalRule','SpecialChar','PageBreak'],
        ['Font', 'FontSize', 'TextColor', 'BGColor', 'syntaxhighlight']
    ];
    config.toolbar_User =
	[
       ['Preview', 'Maximize', 'Cut', 'Copy', 'Paste', 'PasteText', '-', 'Bold', 'Italic', 'Underline', 'Strike', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'Link', 'Unlink', 'Image', '-', 'FontSize', 'TextColor', 'BGColor', 'syntaxhighlight']
    ];
};
