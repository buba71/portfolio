export const CkeditorConfig = {
    toolbarGroups: [{
        "name": "basicstyles",
        "groups": ["basicstyles"]
    },
        {
            "name": "links",
            "groups": ["links"]
        },
        {
            "name": "paragraph",
            "groups": ["list", "blocks"]
        },
        {
            "name": "document",
            "groups": ["mode"]
        },
        {
            "name": "insert",
            "groups": ["insert"]
        },
        {
            "name": "styles",
            "groups": ["styles"]
        },
        {
            "name": "about",
            "groups": ["about"]
        }
    ],
    height: 300,
    extraPlugins: 'codesnippet',
    codeSnippet_theme: 'monokai'
};