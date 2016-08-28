<script type="text/javascript" charset="utf-8">
    // Documentation for client options:
    // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
    $(document).ready(function() {

        var right = 'true';

        if(right == 'true')
        {
            paramUpload = 'upload';
        }else{
            paramUpload = '';
        }

        $('#elfinder').elfinder({
             url : '{{ url("/backend/elfinder/php/connector.minimal.php") }}' ,
             uiOptions : {
                 toolbar : [
                        [paramUpload],
                        // ['back', 'forward'],
                        // ['reload'],
                        // ['home', 'up'],
                        // ['mkdir', 'mkfile', 'upload'],
                        // ['open', 'download', 'getfile'],
                        // ['info'],
                        // ['quicklook'],
                        // ['copy', 'cut', 'paste'],
                        // ['rm'],
                        // ['duplicate', 'rename', 'edit'],
                        // ['extract', 'archive'],
                        // ['search'],
                        // ['view'],
                        // ['help']
                ],
             },
             contextmenu : {
                // navbarfolder menu
               // navbar : ['open', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'info'],
                // current directory menu
                //cwd    : ['reload', 'back', '|', 'upload', 'mkdir', 'mkfile', 'paste', '|', 'info'],
                // current directory file menu
               // files  : ['getfile', '|','', 'quicklook', '|', 'download', '|', 'copy', 'cut', 'paste', 'duplicate', '|', 'rm', '|', 'edit', 'rename', '|', 'archive', 'extract', '|', 'info']
               files  : ['getfile', '|','', 'rm', '|']
             },
            lang: 'id'                    // language (OPTIONAL)
        });
    });
</script> 

https://code.google.com/p/avecms/source/browse/trunk/admin/redactor/elfinder/js/elFinder.options.js?r=256