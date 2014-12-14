<script>
    function updateOpener() {
        window.opener.document.reg_form.latitude.value = document.reg_form.latitude.value;
        window.opener.document.reg_form.longitude.value = document.reg_form.longitude.value;
        window.opener.document.reg_form.city.value = document.reg_form.city.value;
        window.opener.document.reg_form.address.value = document.reg_form.address.value;
        window.opener.document.reg_form.postal_code.value = document.reg_form.postal_code.value;
        window.close();
    }

</script>

