var editor = new EpicEditor({
    basePath: cookbook.basePath,
    textarea: 'code',
    useNativeFullscreen: false,
    clientSideStorage: false,
    autogrow: true,
    theme: {
        editor: 'themes/editor/epic-light.css'
    },
    button: {
        fullscreen: false
    }
});
