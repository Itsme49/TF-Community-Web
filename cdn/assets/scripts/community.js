const Core = new Vue({
    el: "#core",
    data:{
        locale: document.body.getAttribute("l"),
        locales:[
            { code: "en", title:"English" },
            { code: "ru", title:"Русский" },
            { code: "fr", title:"Français" },
            { code: "by", title:"Беларускі" },
            { code: "ro", title:"Română" },
            { code: "ua", title:"Український" }
        ]
    },
    methods: {
        ChangeLocales(event) {
            document.location.href="/l/"+event.target.value+"?redirect="+document.location.href;
        }
    }
})