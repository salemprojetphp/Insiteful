(function() {
    var id = document.currentScript.getAttribute("data-id");
    var server = "http://localhost:8000/track";

    // if (!sessionStorage.getItem("_swa")&& !document.referrer.startsWith(location.protocol + "//" + location.host)) {
        setTimeout(function() {
            sessionStorage.setItem("_swa", "1");
            var formData = new FormData();
            formData.append("referrer", document.referrer);
            formData.append("screen", screen.width + "x" + screen.height);
            formData.append("id", id);
            // formData.append("website", window.location.hostname || 'localhost')
            formData.append("website", 'insat.tn')

            fetch(server, {
                method: "POST",
                body: formData
            });
        }, 4500);
    // }
})()
