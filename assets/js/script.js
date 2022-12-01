$(document).ready(function () {
    // header menu
    $(".nav-link").on("mouseenter", function () {
        $(".dropdown-menu").fadeOut(100);   // faccio sparire gli altri dropdown
        $(this).next().fadeIn(100); // tengo solo quello su cui ho il mouse
    });
    // quando esco dalla navbar tutti i menu a tendina spariscono
    $(".navbar").on("mouseleave", function () {
        $(".dropdown-menu").fadeOut(100); 
    })

    // sblocco il select delle categorie optional
    $("#models").on("change", function () {
        let car_id = $(this).val();
        $.ajax({
            dataType: "json",   // specifica il tipo di dato che il server restituisce
            url: "assets/includes/categories.inc.php", // è come l'action della form
            data: {    // specifica il dato da inviare al server
                car_id: car_id  // il primo car_id è un nome da me deciso, il secondo è la variabile inizializzata sopra
            },
            beforeSend: function () {   // funzione da eseguire prima dell'invio al server
                $("#categories").attr("disabled", "disabled");
                $("#categories").html("<option selected>Categoria optional</option>");
            },
            success: function (data) {  // funzione da eseguire una volta ottenuta risposta positiva dal server
                $("#categories").append(data);
                $("#categories").removeAttr("disabled");
            }
        });

        // creo immagine di sfondo
        $.ajax({
            dataType: "json",
            url: "assets/includes/sfondo.inc.php",
            data: {
                car_id: car_id
            },
            beforeSend: function () {
                $("main").remove();
                $("#selection").after("<main></main>");
                $("main").html("<div class='d-flex justify-content-center car-layout'></div>");
                $("main .d-flex").append("<div class='col-md-10' id='sfondo'></div>");
            },
            success: function (data) {
                $("#sfondo").css("background-image", "url(" + data + ")");
            }
        });

        // creo colonna prezzo
        $.ajax({
            dataType: "json",
            url: "assets/includes/prezzo_base.inc.php",
            data: {
                car_id: car_id
            },
            beforeSend: function () {
                $("#prezzo").remove();
                $("main .d-flex").append("<div class='col-md-2 px-3' id='prezzo'><h3 class='mb-3'>Carrello</h3></div>");
            },
            success: function (data) {
                $("#prezzo").append(data);
            }
        });
    });

    // sblocco select degli optionals per la categoria selezionata
    $("#categories").on("change", function () {
        let category_id = $(this).val();
        let car_id = $("#models").val();
        //console.log(card_id);
        $.ajax({
            dataType: "json",
            url: "assets/includes/optionals.inc.php",
            data: {
                car_id: car_id,
                category_id: category_id
            },
            beforeSend: function () {
                $("#optionals").attr("disabled");
                $("#optionals").html("<option selected>Optional</option>");
            },
            success: function (data) {
                $("#optionals").append(data);
                $("#optionals").removeAttr("disabled");
            }
        });
    });

    // immagine di default per gli optional
    $("#categories").on("change", function () {
        let category_id = $(this).val();
        let optional_id = $("#optionals").val();
        let car_id = $("#models").val();
        $.ajax({
            dataType: "json",
            url: "assets/includes/default.inc.php",
            data: {
                car_id: car_id,
                category_id: category_id
            },
            beforeSend: function () {
                $("#optional_selected").remove();
                $("#sfondo").append("<div class='' id='optional_selected'>");
            },
            success: function (data) {
                $("#optional_selected").append(data);
            }
        });
    });

    // aggiungo le immagini per gli optional selezionati
    $("#optionals").on("change", function () {
        let optional_id = $(this).val();
        let category_id = $("#categories").val();
        let car_id = $("#models").val();
        $.ajax({
            dataType: "json",
            url: "assets/includes/result.inc.php",
            data: {
                car_id: car_id,
                optional_id: optional_id
            },
            beforeSend: function () {
                $("#optional_selected").remove();
                $("#sfondo").append("<div class='' id='optional_selected'>");
            },
            success: function (data) {
                $("#optional_selected").append(data);
            }
        });

        // aggiungo prezzo optionals
        $.ajax({
            dataType: "json",
            url: "assets/includes/prezzo_opt.inc.php",
            data: {
                category_id: category_id,
                optional_id: optional_id
            },
            beforeSend: function () {
                $("#prezzo_opt").remove();
                $("#prezzo").append("<div id='prezzo_opt'><h5 class='text-muted'>Optional</h5></div>");
            },
            success: function (data) {
                $("#prezzo_opt").append(data);
            }
        });

        // aggiungo prezzo totale
        $.ajax({
            dataType: "json",
            url: "assets/includes/prezzo_tot.inc.php",
            data: {
                car_id: car_id,
                optional_id: optional_id
            },
            beforeSend: function () {
                $("#prezzo_tot").remove();
                $("#prezzo").append("<div class='border-top py-3' id='prezzo_tot'><h5 class='text-muted'>Totale</h5></div>");
            },
            success: function (data) {
                $("#prezzo_tot").append(data);
            }
        });
    });
});