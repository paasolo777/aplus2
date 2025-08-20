<script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>" type="text/javascript"></script>
<script type="text/javascript">
    MathJax = {
        tex: {
            inlineMath: [
                ['$', '$'],
                ['\\(', '\\)']
            ]
        }
    };
</script>
<script type="text/javascript">
    function ckeditor_initialize(type = '', note_id = false) {
        const CKEDITOR_CONFIG = {
            extraPlugins: 'mathjax',
            mathJaxLib: "<?= base_url('assets/MathJax/MathJax.js?config=TeX-AMS_HTML') ?>",
            height: 100,
            removeButtons: 'Paste,PasteText,PasteFromWord,Anchor,Image',
            removePlugins: 'scayt'
        };

        const requiredFieldWarning = 'This field is required.';

        let requiredEditorIds = ['question', 'a', 'b'];
        let EditorIds = ['c', 'd'];
        <?php if (is_option_e_mode_enabled()) { ?>
            EditorIds.push('e');
        <?php } ?>
        let removeEditorIds = [];

        if (type == 2) {
            removeEditorIds.push(...EditorIds);
        } else if (type == 1 || type == '') {
            requiredEditorIds.push(...EditorIds);
        }

        destroyEditors([...requiredEditorIds, ...removeEditorIds]);
        initializeEditors(requiredEditorIds, CKEDITOR_CONFIG, requiredFieldWarning);

        initializeEditors(removeEditorIds, CKEDITOR_CONFIG, requiredFieldWarning, true);

        if (note_id) {
            const noteIds = ['note'];
            destroyEditors([noteIds]);
            initializeEditors(noteIds, CKEDITOR_CONFIG);
        }


        if (CKEDITOR.env.ie && CKEDITOR.env.version == 8) {
            document.getElementById('ie8-warning').className = 'tip alert';
        }
    }

    function initializeEditors(editorIds, config, warning = '', removeListeners = false) {
        editorIds.forEach(id => {
            const editor = CKEDITOR.replace(id, config);
            if (removeListeners && editor) {
                editor.removeAllListeners();
            } else if (warning) {
                editor.on('required', evt => {
                    editor.showNotification(warning, 'warning');
                    evt.cancel();
                });
            }
        });
    }

    function destroyEditors(editorIds) {
        editorIds.forEach(id => {
            const editor = CKEDITOR.instances[id];
            if (editor) {
                editor.destroy();
            }
        });
    }
</script>