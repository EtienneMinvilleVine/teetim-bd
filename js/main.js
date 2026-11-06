document.querySelectorAll("form.controle select").forEach(
    eltSelect => eltSelect.addEventListener("change", 
        evt => evt.target.form.submit()
    )
);
